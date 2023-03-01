<?php

namespace Pterodactyl\Models;

use Illuminate\Support\Collection;

class Permission extends Model
{
    /**
     * The resource name for this model when it is transformed into an
     * API representation using fractal.
     */
    public const RESOURCE_NAME = 'subuser_permission';

    /**
     * Constants defining different permissions available.
     */
    public const ACTION_WEBSOCKET_CONNECT = 'websocket.connect';
    public const ACTION_CONTROL_CONSOLE = 'control.console';
    public const ACTION_CONTROL_START = 'control.start';
    public const ACTION_CONTROL_STOP = 'control.stop';
    public const ACTION_CONTROL_RESTART = 'control.restart';

    public const ACTION_DATABASE_READ = 'database.read';
    public const ACTION_DATABASE_CREATE = 'database.create';
    public const ACTION_DATABASE_UPDATE = 'database.update';
    public const ACTION_DATABASE_DELETE = 'database.delete';
    public const ACTION_DATABASE_VIEW_PASSWORD = 'database.view_password';

    public const ACTION_SCHEDULE_READ = 'schedule.read';
    public const ACTION_SCHEDULE_CREATE = 'schedule.create';
    public const ACTION_SCHEDULE_UPDATE = 'schedule.update';
    public const ACTION_SCHEDULE_DELETE = 'schedule.delete';

    public const ACTION_USER_READ = 'user.read';
    public const ACTION_USER_CREATE = 'user.create';
    public const ACTION_USER_UPDATE = 'user.update';
    public const ACTION_USER_DELETE = 'user.delete';

    public const ACTION_BACKUP_READ = 'backup.read';
    public const ACTION_BACKUP_CREATE = 'backup.create';
    public const ACTION_BACKUP_DELETE = 'backup.delete';
    public const ACTION_BACKUP_DOWNLOAD = 'backup.download';
    public const ACTION_BACKUP_RESTORE = 'backup.restore';

    public const ACTION_ALLOCATION_READ = 'allocation.read';
    public const ACTION_ALLOCATION_CREATE = 'allocation.create';
    public const ACTION_ALLOCATION_UPDATE = 'allocation.update';
    public const ACTION_ALLOCATION_DELETE = 'allocation.delete';

    public const ACTION_FILE_READ = 'file.read';
    public const ACTION_FILE_READ_CONTENT = 'file.read-content';
    public const ACTION_FILE_CREATE = 'file.create';
    public const ACTION_FILE_UPDATE = 'file.update';
    public const ACTION_FILE_DELETE = 'file.delete';
    public const ACTION_FILE_ARCHIVE = 'file.archive';
    public const ACTION_FILE_SFTP = 'file.sftp';

    public const ACTION_STARTUP_READ = 'startup.read';
    public const ACTION_STARTUP_UPDATE = 'startup.update';
    public const ACTION_STARTUP_DOCKER_IMAGE = 'startup.docker-image';

    public const ACTION_SETTINGS_RENAME = 'settings.rename';
    public const ACTION_SETTINGS_REINSTALL = 'settings.reinstall';

    public const ACTION_ACTIVITY_READ = 'activity.read';

    /**
     * Should timestamps be used on this model.
     */
    public $timestamps = false;

    /**
     * The table associated with the model.
     */
    protected $table = 'permissions';

    /**
     * Fields that are not mass assignable.
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * Cast values to correct type.
     */
    protected $casts = [
        'subuser_id' => 'integer',
    ];

    public static array $validationRules = [
        'subuser_id' => 'required|numeric|min:1',
        'permission' => 'required|string',
    ];

    /**
     * All the permissions available on the system. You should use self::permissions()
     * to retrieve them, and not directly access this array as it is subject to change.
     *
     * @see \Pterodactyl\Models\Permission::permissions()
     */
    protected static array $permissions = [
        'websocket' => [
            'description' => 'Permite que o usuário se conecte ao websocket do servidor, dando-lhes acesso para visualizar a saída do console e as estatísticas do servidor em tempo real.',
            'keys' => [
                'connect' => 'Permite que um usuário se conecte à instância do websocket para que um servidor transmita o console.',
            ],
        ],

        'control' => [
            'description' => 'Permissões que controlam a capacidade de um usuário de controlar o estado de energia de um servidor ou enviar comandos.',
            'keys' => [
                'console' => 'Permite que um usuário envie comandos para a instância do servidor por meio do console.',
                'start' => 'Permite que um usuário inicie o servidor se ele estiver parado.',
                'stop' => 'Permite que um usuário pare um servidor se ele estiver em execução.',
                'restart' => 'Permite que um usuário execute uma reinicialização do servidor. Isso permite que eles iniciem o servidor se ele estiver offline, mas não coloque o servidor em um estado completamente parado.',
            ],
        ],

        'user' => [
            'description' => 'Permissões que permitem que um usuário gerencie outros subusuários em um servidor. Eles nunca poderão editar sua própria conta ou atribuir permissões que não possuem.',
            'keys' => [
                'create' => 'Permite que um usuário crie novos subusuários para o servidor.',
                'read' => 'Permite que o usuário visualize os subusuários e suas permissões para o servidor.',
                'update' => 'Permite que um usuário modifique outros subusuários.',
                'delete' => 'Permite que um usuário exclua um subusuário do servidor.',
            ],
        ],

        'file' => [
            'description' => 'Permissões que controlam a capacidade do usuário de modificar o sistema de arquivos deste servidor.',
            'keys' => [
                'create' => 'Permite que um usuário crie arquivos e pastas adicionais por meio do painel ou upload direto.',
                'read' => 'Permite que um usuário visualize o conteúdo de um diretório, mas não visualize o conteúdo ou baixe arquivos.',
                'read-content' => 'Permite que um usuário visualize o conteúdo de um determinado arquivo. Isso também permitirá que o usuário baixe arquivos.',
                'update' => 'Permite que um usuário atualize o conteúdo de um arquivo ou diretório existente.',
                'delete' => 'Permite que um usuário exclua arquivos ou diretórios.',
                'archive' => 'Permite que um usuário arquive o conteúdo de um diretório, bem como descompacte os arquivos existentes no sistema.',
                'sftp' => 'Permite que um usuário se conecte ao SFTP e gerencie arquivos do servidor usando as outras permissões de arquivo atribuídas.',
            ],
        ],

        'backup' => [
            'description' => 'Permissões que controlam a capacidade do usuário de gerar e gerenciar backups do servidor.',
            'keys' => [
                'create' => 'Permite que um usuário crie novos backups para este servidor.',
                'read' => 'Permite que um usuário visualize todos os backups existentes para este servidor.',
                'delete' => 'Permite que um usuário remova backups do sistema.',
                'download' => 'Permite que um usuário baixe um backup para o servidor. Perigo: isso permite que um usuário acesse todos os arquivos do servidor no backup.',
                'restore' => 'Permite que um usuário restaure um backup para o servidor. Perigo: isso permite que o usuário exclua todos os arquivos do servidor no processo.',
            ],
        ],

        // Controls permissions for editing or viewing a server's allocations.
        'allocation' => [
            'description' => 'Permissões que controlam a capacidade de um usuário de modificar as alocações de porta para este servidor.',
            'keys' => [
                'read' => 'Permite que um usuário visualize todas as alocações atualmente atribuídas a este servidor. Os usuários com qualquer nível de acesso a esse servidor sempre podem visualizar a alocação primária.',
                'create' => 'Permite que um usuário atribua alocações adicionais ao servidor.',
                'update' => 'Permite que um usuário altere a alocação do servidor principal e anexe notas a cada alocação.',
                'delete' => 'Permite que um usuário exclua uma alocação do servidor.',
            ],
        ],

        // Controls permissions for editing or viewing a server's startup parameters.
        'startup' => [
            'description' => 'Permissões que controlam a capacidade de um usuário visualizar os parâmetros de inicialização deste servidor.',
            'keys' => [
                'read' => 'Permite que um usuário visualize as variáveis ​​de inicialização de um servidor',
                'update' => 'Permite que um usuário modifique as variáveis ​​de inicialização para o servidor.',
                'docker-image' => 'Permite que um usuário modifique a imagem do Docker usada ao executar o servidor.',
            ],
        ],

        'database' => [
            'description' => 'Permissões que controlam o acesso de um usuário ao gerenciamento de Database para este servidor.',
            'keys' => [
                'create' => 'Permite que um usuário crie um novo Database para este servidor.',
                'read' => 'Permite que um usuário visualize o Database associado a este servidor.',
                'update' => 'Permite que um usuário alterne a senha em uma instância de Database. Se o usuário não tiver a permissão view_password, ele não verá a senha atualizada.',
                'delete' => 'Permite que um usuário remova uma instância de Database deste servidor.',
                'view_password' => 'Permite que um usuário visualize a senha associada a uma instância de Database para este servidor.',
            ],
        ],

        'schedule' => [
            'description' => 'Permissões que controlam o acesso de um usuário ao gerenciamento de agendamento para este servidor.',
            'keys' => [
                'create' => 'Permite que um usuário crie novos agendamentos para este servidor.', // task.create-schedule
                'read' => 'Permite que um usuário visualize os agendamentos e as tarefas associadas a eles para este servidor.', // task.view-schedule, task.list-schedules
                'update' => 'Permite que um usuário atualize agendamentos e agende tarefas para este servidor.', // task.edit-schedule, task.queue-schedule, task.toggle-schedule
                'delete' => 'Permite que um usuário exclua agendamentos para este servidor.', // task.delete-schedule
            ],
        ],

        'settings' => [
            'description' => 'Permissões que controlam o acesso de um usuário às configurações deste servidor.',
            'keys' => [
                'rename' => 'Permite que um usuário renomeie este servidor e altere a descrição dele.',
                'reinstall' => 'Permite que um usuário acione uma reinstalação deste servidor.',
            ],
        ],

        'activity' => [
            'description' => 'Permissões que controlam o acesso de um usuário aos logs de atividade do servidor.',
            'keys' => [
                'read' => 'Permite que um usuário visualize os logs de atividade do servidor.',
            ],
        ],
    ];

    /**
     * Returns all the permissions available on the system for a user to
     * have when controlling a server.
     */
    public static function permissions(): Collection
    {
        return Collection::make(self::$permissions);
    }
}
