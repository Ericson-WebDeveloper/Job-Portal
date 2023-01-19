import redirect from "./redirect";

export default function employeer({next, store, router}) {
    const roles = store.getters['user/GET_ROLES'];
    
    // if(!store.state.auth.loggedin) { // change in verify user action kung true or false
    //     return router.push({name: 'Login'});
    // }

    let canEnter = false;
    if(roles) {
        roles.forEach((role) => {
            if(role.name == 'employeer' && role.id == 3) {
                canEnter = true;
            } 
        });
    }
    //console.log(nextMiddle, 'before if employeer');
    if(canEnter) {
        return next(true);    
    } else {
       return redirect(roles, router, next); 
    }

    // roles.forEach((role) => {
    //     if(role.name == 'user' && role.id == 1) {
    //         return router.push({name: 'User-DashBoard'});
    //     }  
    //     if(role.name == 'admin' && role.id == 2) {
    //         return router.push({name: 'Admin-Dashboard'});
    //     } 
    // });

}