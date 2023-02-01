<?php

namespace Pterodactyl\Console\Commands\Environment;

use DateTimeZone;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\Kernel;
use Pterodactyl\Traits\Commands\EnvironmentWriterTrait;

class AppSettingsCommand extends Command
{
    use EnvironmentWriterTrait;

    public const CACHE_DRIVERS = [
        'redis' => 'Redis (recommended)',
        'memcached' => 'Memcached',
        'file' => 'Filesystem',
    ];

    public const SESSION_DRIVERS = [
        'redis' => 'Redis (recomendado)',
        'memcached' => 'Memcached',
        'database' => 'MySQL Database',
        'file' => 'Filesystem',
        'cookie' => 'Cookie',
    ];

    public const QUEUE_DRIVERS = [
        'redis' => 'Redis (recommended)',
        'database' => 'MySQL Database',
        'sync' => 'Sync',
    ];

    protected $description = 'Defina as configurações básicas do ambiente para o painel.';

    protected $signature = 'p:environment:setup
                            {--new-salt : Se deve ou não gerar um novo sal para Hashids.}
                            {--author= : O e-mail ao qual os serviços criados nesta instância devem ser vinculados.}
                            {--url= : A URL em que este painel está sendo executado.}
                            {--timezone= : O fuso horário a ser usado para os horários do painel.}
                            {--cache= : O back-end do driver de cache a ser usado.}
                            {--session= : O back-end do driver de sessão a ser usado.}
                            {--queue= : O back-end do driver de iniciação(Queue) a ser usado.}
                            {--redis-host= : Host Redis a ser usado para conexões.}
                            {--redis-pass= : Senha usada para se conectar ao Redis.}
                            {--redis-port= : Porta para conectar ao Redis over.}
                            {--settings-ui= : Ativar ou desativar a interface do usuário de configurações.}
                            {--telemetry= : Ative ou desative a telemetria anônima.}';

    protected array $variables = [];

    /**
     * AppSettingsCommand constructor.
     */
    public function __construct(private Kernel $console)
    {
        parent::__construct();
    }

    /**
     * Handle command execution.
     *
     * @throws \Pterodactyl\Exceptions\PterodactylException
     */
    public function handle(): int
    {
        if (empty(config('hashids.salt')) || $this->option('new-salt')) {
            $this->variables['HASHIDS_SALT'] = str_random(20);
        }

        $this->output->comment('Forneça o endereço de e-mail do qual os eggs serão exportados por este Painel devem ser. Este deve ser um endereço de e-mail válido.');
        $this->variables['APP_SERVICE_AUTHOR'] = $this->option('author') ?? $this->ask(
            'E-mail do autor do Egg',
            config('pterodactyl.service.author', 'unknown@unknown.com')
        );

        if (!filter_var($this->variables['APP_SERVICE_AUTHOR'], FILTER_VALIDATE_EMAIL)) {
            $this->output->error('O e-mail do autor do egg fornecido é inválido.');

            return 1;
        }

        $this->output->comment('A URL do aplicativo DEVE começar com https:// ou http:// dependendo se você estiver usando SSL ou não. Se você não incluir o esquema, seus e-mails e outros conteúdos serão vinculados ao local errado.');
        $this->variables['APP_URL'] = $this->option('url') ?? $this->ask(
            'URL do aplicativo',
            config('app.url', 'https://example.com')
        );

        $this->output->comment('O fuso horário deve corresponder a um dos fusos horários suportados pelo PHP. Se você não tiver certeza, por favor, consulte https://php.net/manual/en/timezones.php.');
        $this->variables['APP_TIMEZONE'] = $this->option('timezone') ?? $this->anticipate(
            'Fuso horário do aplicativo',
            DateTimeZone::listIdentifiers(),
            config('app.timezone')
        );

        $selected = config('cache.default', 'redis');
        $this->variables['CACHE_DRIVER'] = $this->option('cache') ?? $this->choice(
            'Driver de Cache',
            self::CACHE_DRIVERS,
            array_key_exists($selected, self::CACHE_DRIVERS) ? $selected : null
        );

        $selected = config('session.driver', 'redis');
        $this->variables['SESSION_DRIVER'] = $this->option('session') ?? $this->choice(
            'Driver da Sessão ',
            self::SESSION_DRIVERS,
            array_key_exists($selected, self::SESSION_DRIVERS) ? $selected : null
        );

        $selected = config('queue.default', 'redis');
        $this->variables['QUEUE_CONNECTION'] = $this->option('queue') ?? $this->choice(
            'Driver da Iniciação(Queue)',
            self::QUEUE_DRIVERS,
            array_key_exists($selected, self::QUEUE_DRIVERS) ? $selected : null
        );

        if (!is_null($this->option('settings-ui'))) {
            $this->variables['APP_ENVIRONMENT_ONLY'] = $this->option('settings-ui') == 'true' ? 'false' : 'true';
        } else {
            $this->variables['APP_ENVIRONMENT_ONLY'] = $this->confirm('Ativar o editor de configurações baseado em interface do usuário?', true) ? 'false' : 'true';
        }

        $this->output->comment('Por favor, faça referência https://pterodactyl.io/panel/1.0/additional_configuration.html#telemetria para obter informações mais detalhadas sobre coleta e dados de telemetria.');
        $this->variables['PTERODACTYL_TELEMETRY_ENABLED'] = $this->option('telemetry') ?? $this->confirm(
            'Ativar o envio de dados de telemetria anônimos?',
            config('pterodactyl.telemetry.enabled', true)
        ) ? 'true' : 'false';

        // Make sure session cookies are set as "secure" when using HTTPS
        if (str_starts_with($this->variables['APP_URL'], 'https://')) {
            $this->variables['SESSION_SECURE_COOKIE'] = 'true';
        }

        $this->checkForRedis();
        $this->writeToEnvironment($this->variables);

        $this->info($this->console->output());

        return 0;
    }

    /**
     * Check if redis is selected, if so, request connection details and verify them.
     */
    private function checkForRedis()
    {
        $items = collect($this->variables)->filter(function ($item) {
            return $item === 'redis';
        });

        // Redis was not selected, no need to continue.
        if (count($items) === 0) {
            return;
        }

        $this->output->note('Você selecionou o driver Redis para uma ou mais opções, forneça informações de conexão válidas abaixo. Na maioria dos casos, você pode usar os padrões fornecidos, a menos que tenha modificado sua configuração.');
        $this->variables['REDIS_HOST'] = $this->option('redis-host') ?? $this->ask(
            'Host da Redis',
            config('database.redis.default.host')
        );

        $askForRedisPassword = true;
        if (!empty(config('database.redis.default.password'))) {
            $this->variables['REDIS_PASSWORD'] = config('database.redis.default.password');
            $askForRedisPassword = $this->confirm('Parece que uma senha já está definida para o Redis, gostaria de alterá-la?');
        }

        if ($askForRedisPassword) {
            $this->output->comment('Por padrão, uma instância do servidor Redis não tem senha, pois está sendo executada localmente e inacessível para o mundo externo. Se for esse o caso, basta pressionar Enter sem inserir um valor.');
            $this->variables['REDIS_PASSWORD'] = $this->option('redis-pass') ?? $this->output->askHidden(
                'Senha Redis'
            );
        }

        if (empty($this->variables['REDIS_PASSWORD'])) {
            $this->variables['REDIS_PASSWORD'] = 'null';
        }

        $this->variables['REDIS_PORT'] = $this->option('redis-port') ?? $this->ask(
            'Porta do Redis',
            config('database.redis.default.port')
        );
    }
}
