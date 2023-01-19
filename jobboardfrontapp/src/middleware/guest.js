import redirect from "./redirect";

export default function auth({next, store, router}) {
    const roles = store.getters['user/GET_ROLES'];
    if(store.state.auth.loggedin) {
        return redirect(roles, router);
    } else {
       return next(); 
    }  
}