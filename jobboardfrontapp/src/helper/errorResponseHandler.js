import store from '@/store/index';
import csrf from '../axios/csrf';

export async function handleResponse(error) {
    if(error.response.status && error.response.status ==  422){
        let err = {errors: error.response.data.errors}
        throw err;
    } else if(error.response.status && error.response.status ==  400){
        let err = {message: error.response.data.error}
        throw err;
    } else if(error.response.status && error.response.status ==  401 || error.response.status ==  403){
        // let err = {message: 'You have no authorization for this action', status: error.response.status}
        // throw err;
        try {
            alert("You are UnAuthenticated. Sorry you were forcing to logout now.")
            await store.dispatch('auth/LOGOUT');
        } catch {
            store.auth.state.token = null;
            localStorage.removeItem('user_data');
            csrf.deleteToken();
        }finally {
            location.reload();
        }
    } else if(error.response.status && error.response.status ==  402){
        alert(`${error.response.data.error} if you want use the system application continuously.`);
        return false;
    } else if(error.response.status && error.response.status ==  429){
        alert(`${error.response.data.message}`);
        return false;
    } else if(error.request){
        let err = {message: error.request, status: error.response.status}
        throw err;
    } else{
        throw new Error('Something wrong in server');
    }
}