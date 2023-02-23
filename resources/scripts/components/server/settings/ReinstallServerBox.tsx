import React, { useEffect, useState } from 'react';
import { ServerContext } from '@/state/server';
import TitledGreyBox from '@/components/elements/TitledGreyBox';
import reinstallServer from '@/api/server/reinstallServer';
import { Actions, useStoreActions } from 'easy-peasy';
import { ApplicationStore } from '@/state';
import { httpErrorToHuman } from '@/api/http';
import tw from 'twin.macro';
import { Button } from '@/components/elements/button/index';
import { Dialog } from '@/components/elements/dialog';

export default () => {
    const uuid = ServerContext.useStoreState((state) => state.server.data!.uuid);
    const [modalVisible, setModalVisible] = useState(false);
    const { addFlash, clearFlashes } = useStoreActions((actions: Actions<ApplicationStore>) => actions.flashes);

    const reinstall = () => {
        clearFlashes('settings');
        reinstallServer(uuid)
            .then(() => {
                addFlash({
                    key: 'settings',
                    type: 'success',
                    message: 'Seu servidor começou o processo de reinstalação.',
                });
            })
            .catch((error) => {
                console.error(error);

                addFlash({ key: 'settings', type: 'error', message: httpErrorToHuman(error) });
            })
            .then(() => setModalVisible(false));
    };

    useEffect(() => {
        clearFlashes();
    }, []);

    return (
        <TitledGreyBox title={'Reinstalar servidor'} css={tw`relative`}>
            <Dialog.Confirm
                open={modalVisible}
                title={'Confirmar a reinstalação do servidor'}
                confirm={'Sim, reinstalar o servidor'}
                onClose={() => setModalVisible(false)}
                onConfirmed={reinstall}
            >
                Seu servidor será interrompido e alguns arquivos poderão ser excluídos ou modificados durante este processo, você tem certeza você deseja continuar?
            </Dialog.Confirm>
            <p css={tw`text-sm`}>
            A reinstalação de seu servidor irá pará-lo e, em seguida, executar novamente o script de instalação que inicialmente o definiu
                up.&nbsp;
                <strong css={tw`font-medium`}>
                Alguns arquivos podem ser excluídos ou modificados durante este processo, 
                por favor fazer backup de seus dados antes continuar.
                </strong>
            </p>
            <div css={tw`mt-6 text-right`}>
                <Button.Danger variant={Button.Variants.Secondary} onClick={() => setModalVisible(true)}>
                    Reinstalar o servidor
                </Button.Danger>
            </div>
        </TitledGreyBox>
    );
};
