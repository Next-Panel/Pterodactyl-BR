<?php

namespace Pterodactyl\Console\Commands\Overrides;

use Illuminate\Foundation\Console\KeyGenerateCommand as BaseKeyGenerateCommand;

class KeyGenerateCommand extends BaseKeyGenerateCommand
{
    /**
     * Override the default Laravel key generation command to throw a warning to the user
     * if it appears that they have already generated an application encryption key.
     */
    public function handle()
    {
        if (!empty(config('app.key')) && $this->input->isInteractive()) {
            $this->output->warning('Parece que você já configurou uma chave de criptografia de aplicativo. Continuando com este processo, substitua essa chave e cause corrupção de dados para quaisquer dados criptografados existentes. NÃO CONTINUE A MENOS QUE SAIBA O QUE ESTÁ FAZENDO.');
            if (!$this->confirm('Entendo as consequências de executar este comando e aceito toda a responsabilidade pela perda de dados criptografados.')) {
                return;
            }

            if (!$this->confirm('Tem certeza que deseja continuar? Alterar a chave de criptografia do aplicativo CAUSARÁ PERDA DE DADOS.')) {
                return;
            }
        }

        parent::handle();
    }
}
