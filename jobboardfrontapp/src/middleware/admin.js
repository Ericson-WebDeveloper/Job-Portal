import redirect from './redirect'

export default function admin({next, store, router}) {
    const roles = store.getters['user/GET_ROLES'];

    // if(!store.getters['auth/GET_LOGGED_STATUS']) {
    //     return router.push({name: 'Login'});
    // }

    let canEnter = false;

    if(roles) {
        roles.forEach((role) => {
            if(role.name == 'admin' && role.id == 2) {
                canEnter = true;
            } 
        });
    }
    
    if(canEnter) {
        return next(); 
    } else {
       return redirect(roles, router); 
    }

    
    // roles.forEach((role) => {
    //     if(role.name == 'user' && role.id == 1) {
    //         return router.push({name: 'User-DashBoard'});
    //     }  
    //     if(role.name == 'employeer' && role.id == 3) {
    //         return router.push({name: 'Employeer-Dashboard'});
    //     } 
    // });

}