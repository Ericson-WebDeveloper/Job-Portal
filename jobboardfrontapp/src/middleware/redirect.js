
export default function redirect(roles, router) {
    roles?.forEach((role) => {
        if(role.name == 'user' && role.id == 1) {
            return router.push({name: 'User-Dashboard'});
        }  
        else if(role.name == 'employeer' && role.id == 3) {
            return router.push({name: 'Employeer-Dashboard'});
        } 
        else if(role.name == 'admin' && role.id == 2) {
            return router.push({name: 'Admin-Dashboard'});
        }
    });
    // return next();
}