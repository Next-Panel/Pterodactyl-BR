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
            'description' => 'Permite que o usu??rio se conecte ao websocket do servidor, dando-lhes acesso para visualizar a sa??da do console e as estat??sticas do servidor em tempo real.',
            'keys' => [
                'connect' => 'Permite que um usu??rio se conecte ?? inst??ncia do websocket para que um servidor transmita o console.',
            ],
        ],

        'control' => [
            'description' => 'Permiss??es que controlam a capacidade de um usu??rio de controlar o estado de energia de um servidor ou enviar comandos.',
            'keys' => [
                'console' => 'Permite que um usu??rio envie comandos para a inst??ncia do servidor por meio do console.',
                'start' => 'Permite que um usu??rio inicie o servidor se ele estiver parado.',
                'stop' => 'Permite que um usu??rio pare um servidor se ele estiver em execu????o.',
                'restart' => 'Permite que um usu??rio execute uma reinicializa????o do servidor. Isso permite que eles iniciem o servidor se ele estiver offline, mas n??o coloque o servidor em um estado completamente parado.',
            ],
        ],

        'user' => [
            'description' => 'Permiss??es que permitem que um usu??rio gerencie outros subusu??rios em um servidor. Eles nunca poder??o editar sua pr??pria conta ou atribuir permiss??es que n??o possuem.',
            'keys' => [
                'create' => 'Permite que um usu??rio crie novos subusu??rios para o servidor.',
                'read' => 'Permite que o usu??rio visualize os subusu??rios e suas permiss??es para o servidor.',
                'update' => 'Permite que um usu??rio modifique outros subusu??rios.',
                'delete' => 'Permite que um usu??rio exclua um subusu??rio do servidor.',
            ],
        ],

        'file' => [
            'description' => 'Permiss??es que controlam a capacidade do usu??rio de modificar o sistema de arquivos deste servidor.',
            'keys' => [
                'create' => 'Permite que um usu??rio crie arquivos e pastas adicionais por meio do painel ou upload direto.',
                'read' => 'Permite que um usu??rio visualize o conte??do de um diret??rio, mas n??o visualize o conte??do ou baixe arquivos.',
                'read-content' => 'Permite que um usu??rio visualize o conte??do de um determinado arquivo. Isso tamb??m permitir?? que o usu??rio baixe arquivos.',
                'update' => 'Permite que um usu??rio atualize o conte??do de um arquivo ou diret??rio existente.',
                'delete' => 'Permite que um usu??rio exclua arquivos ou diret??rios.',
                'archive' => 'Permite que um usu??rio arquive o conte??do de um diret??rio, bem como descompacte os arquivos existentes no sistema.',
                'sftp' => 'Permite que um usu??rio se conecte ao SFTP e gerencie arquivos do servidor usando as outras permiss??es de arquivo atribu??das.',
            ],
        ],

        'backup' => [
            'description' => 'Permiss??es que controlam a capacidade do usu??rio de gerar e gerenciar backups do servidor.',
            'keys' => [
                'create' => 'Permite que um usu??rio crie novos backups para este servidor.',
                'read' => 'Permite que um usu??rio visualize todos os backups existentes para este servidor.',
                'delete' => 'Permite que um usu??rio remova backups do sistema.',
                'download' => 'Permite que um usu??rio baixe um backup para o servidor. Perigo: isso permite que um usu??rio acesse todos os arquivos do servidor no backup.',
                'restore' => 'Permite que um usu??rio restaure um backup para o servidor. Perigo: isso permite que o usu??rio exclua todos os arquivos do servidor no processo.',
            ],
        ],

        // Controls permissions for editing or viewing a server's allocations.
        'allocation' => [
            'description' => 'Permiss??es que controlam a capacidade de um usu??rio de modificar as aloca????es de porta para este servidor.',
            'keys' => [
                'read' => 'Permite que um usu??rio visualize todas as aloca????es atualmente atribu??das a este servidor. Os usu??rios com qualquer n??vel de acesso a esse servidor sempre podem visualizar a aloca????o prim??ria.',
                'create' => 'Permite que um usu??rio atribua aloca????es adicionais ao servidor.',
                'update' => 'Permite que um usu??rio altere a aloca????o do servidor principal e anexe notas a cada aloca????o.',
                'delete' => 'Permite que um usu??rio exclua uma aloca????o do servidor.',
            ],
        ],

        // Controls permissions for editing or viewing a server's startup parameters.
        'startup' => [
            'description' => 'Permiss??es que controlam a capacidade de um usu??rio visualizar os par??metros de inicializa????o deste servidor.',
            'keys' => [
                'read' => 'Permite que um usu??rio visualize as vari??veis ??????de inicializa????o de um servidor',
                'update' => 'Permite que um usu??rio modifique as vari??veis ??????de inicializa????o para o servidor.',
                'docker-image' => 'Permite que um usu??rio modifique a imagem do Docker usada ao executar o servidor.',
            ],
        ],

        'database' => [
            'description' => 'Permiss??es que controlam o acesso de um usu??rio ao gerenciamento de Database para este servidor.',
            'keys' => [
                'create' => 'Permite que um usu??rio crie um novo Database para este servidor.',
                'read' => 'Permite que um usu??rio visualize o Database associado a este servidor.',
                'update' => 'Permite que um usu??rio alterne a senha em uma inst??ncia de Database. Se o usu??rio n??o tiver a permiss??o view_password, ele n??o ver?? a senha atualizada.',
                'delete' => 'Permite que um usu??rio remova uma inst??ncia de Database deste servidor.',
                'view_password' => 'Permite que um usu??rio visualize a senha associada a uma inst??ncia de Database para este servidor.',
            ],
        ],

        'schedule' => [
            'description' => 'Permiss??es que controlam o acesso de um usu??rio ao gerenciamento de agendamento para este servidor.',
            'keys' => [
                'create' => 'Permite que um usu??rio crie novos agendamentos para este servidor.', // task.create-schedule
                'read' => 'Permite que um usu??rio visualize os agendamentos e as tarefas associadas a eles para este servidor.', // task.view-schedule, task.list-schedules
                'update' => 'Permite que um usu??rio atualize agendamentos e agende tarefas para este servidor.', // task.edit-schedule, task.queue-schedule, task.toggle-schedule
                'delete' => 'Permite que um usu??rio exclua agendamentos para este servidor.', // task.delete-schedule
            ],
        ],

        'settings' => [
            'description' => 'Permiss??es que controlam o acesso de um usu??rio ??s configura????es deste servidor.',
            'keys' => [
                'rename' => 'Permite que um usu??rio renomeie este servidor e altere a descri????o dele.',
                'reinstall' => 'Permite que um usu??rio acione uma reinstala????o deste servidor.',
            ],
        ],

        'activity' => [
            'description' => 'Permiss??es que controlam o acesso de um usu??rio aos logs de atividade do servidor.',
            'keys' => [
                'read' => 'Permite que um usu??rio visualize os logs de atividade do servidor.',
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
