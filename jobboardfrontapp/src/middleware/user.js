import redirect from "./redirect";

export default function user({next, store, router}) {
    const roles = store.getters['user/GET_ROLES'];

    // if(!store.state.auth.loggedin) {
    //     return router.push({name: 'Login'});
    // }
        
    let canEnter = false;
    if(roles) {
        roles.forEach((role) => {
            if(role.name == 'user' && role.id == 1) {
                canEnter = true;
            } 
        });
    }

    if(canEnter) {

        return next(); 
        
        // return next();
    } else {
        return redirect(roles, router);
    }

    // roles.forEach((role) => {
    //     if(role.name == 'employeer' && role.id == 3) {
    //         return router.push({name: 'Employeer-Dashboard'});
    //     }  
    //     if(role.name == 'admin' && role.id == 2) {
    //         return router.push({name: 'Admin-Dashboard'});
    //     } 
    // });
 
}