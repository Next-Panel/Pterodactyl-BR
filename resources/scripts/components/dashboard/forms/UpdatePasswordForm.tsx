import { Fragment } from 'react';
import { Actions, State, useStoreActions, useStoreState } from 'easy-peasy';
import { Form, Formik, FormikHelpers } from 'formik';
import Field from '@/components/elements/Field';
import * as Yup from 'yup';
import SpinnerOverlay from '@/components/elements/SpinnerOverlay';
import updateAccountPassword from '@/api/account/updateAccountPassword';
import { httpErrorToHuman } from '@/api/http';
import { ApplicationStore } from '@/state';
import tw from 'twin.macro';
import { Button } from '@/components/elements/button/index';

interface Values {
    current: string;
    password: string;
    confirmPassword: string;
}

const schema = Yup.object().shape({
    current: Yup.string().min(1).required('Você deve fornecer sua senha atual.'),
    password: Yup.string().min(8).required(),
    confirmPassword: Yup.string().test(
        'password',
        'A confirmação de senha não corresponde à senha digitada.',
        function (value) {
            return value === this.parent.password;
        },
    ),
});

export default () => {
    const user = useStoreState((state: State<ApplicationStore>) => state.user.data);
    const { clearFlashes, addFlash } = useStoreActions((actions: Actions<ApplicationStore>) => actions.flashes);

    if (!user) {
        return null;
    }

    const submit = (values: Values, { setSubmitting }: FormikHelpers<Values>) => {
        clearFlashes('account:password');
        updateAccountPassword({ ...values })
            .then(() => {
                // @ts-expect-error this is valid
                window.location = '/auth/login';
            })
            .catch(error =>
                addFlash({
                    key: 'account:password',
                    type: 'error',
                    title: 'Erro',
                    message: httpErrorToHuman(error),
                }),
            )
            .then(() => setSubmitting(false));
    };

    return (
        <Fragment>
            <Formik
                onSubmit={submit}
                validationSchema={schema}
                initialValues={{ current: '', password: '', confirmPassword: '' }}
            >
                {({ isSubmitting, isValid }) => (
                    <Fragment>
                        <SpinnerOverlay size={'large'} visible={isSubmitting} />
                        <Form css={tw`m-0`}>
                            <Field id={'current_password'} type={'password'} name={'current'} label={'Senha atual'} />
                            <div css={tw`mt-6`}>
                                <Field
                                    id={'new_password'}
                                    type={'password'}
                                    name={'password'}
                                    label={'Nova Senha'}
                                    description={
                                        'Sua nova senha deve ter pelo menos 8 caracteres de comprimento e ser exclusiva deste site.'
                                    }
                                />
                            </div>
                            <div css={tw`mt-6`}>
                                <Field
                                    id={'confirm_new_password'}
                                    type={'password'}
                                    name={'confirmPassword'}
                                    label={'Confirmar nova senha'}
                                />
                            </div>
                            <div css={tw`mt-6`}>
                                <Button disabled={isSubmitting || !isValid}>Atualizar senha</Button>
                            </div>
                        </Form>
                    </Fragment>
                )}
            </Formik>
        </Fragment>
    );
};
