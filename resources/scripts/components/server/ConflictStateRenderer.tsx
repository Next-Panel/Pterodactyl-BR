import React from 'react';
import { ServerContext } from '@/state/server';
import ScreenBlock from '@/components/elements/ScreenBlock';
import ServerInstallSvg from '@/assets/images/server_installing.svg';
import ServerErrorSvg from '@/assets/images/server_error.svg';
import ServerRestoreSvg from '@/assets/images/server_restore.svg';

export default () => {
    const status = ServerContext.useStoreState((state) => state.server.data?.status || null);
    const isTransferring = ServerContext.useStoreState((state) => state.server.data?.isTransferring || false);
    const isNodeUnderMaintenance = ServerContext.useStoreState(
        (state) => state.server.data?.isNodeUnderMaintenance || false,
    );

    return status === 'installing' || status === 'install_failed' || status === 'reinstall_failed' ? (
        <ScreenBlock
            title={'Instalador em funcionamento'}
            image={ServerInstallSvg}
            message={'Seu servidor deve estar pronto em breve, por favor tente novamente em alguns minutos.'}
        />
    ) : status === 'suspended' ? (
        <ScreenBlock
            title={'Servidor Suspenso'}
            image={ServerErrorSvg}
            message={'Este servidor está suspenso e não pode ser acessado.'}
        />
    ) : isNodeUnderMaintenance ? (
        <ScreenBlock
            title={'O Node esta em manutenção'}
            image={ServerErrorSvg}
            message={'O node deste servidor está atualmente em manutenção.'}
        />
    ) : (
        <ScreenBlock
            title={isTransferring ? 'Transferindo' : 'Restaurando a partir de um Backup'}
            image={ServerRestoreSvg}
            message={
                isTransferring
                    ? 'Seu servidor está sendo transferido para um novo node, por favor, verifique mais tarde.'
                    : 'Seu servidor está sendo restaurado a partir de um backup, por favor verifique de volta em alguns minutos.'
            }
        />
    );
};
