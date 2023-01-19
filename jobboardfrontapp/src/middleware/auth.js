export default async function auth({next, store, router}) {
    let response = await store.dispatch('auth/AUTH_VERIFY_USER');
    //console.log(nextMiddle, 'before if auth');
    if(response) {
        return next(true); 
    } else {
       return router.push({name: 'Login'}); 
    }  
}