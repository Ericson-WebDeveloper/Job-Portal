export default async function subcriptions({next, store, router}) {
    await store.dispatch('payment/GET_SUBCRIPTION');
    let haveSubcription = store.getters['payment/GET_haveSubcription'];
    let isSubcribed = store.getters['payment/GET_isSubcribed'];
    let DuedateToday = store.getters['payment/GET_DuedateToday'];
    let DueDate = store.getters['payment/GET_Duedate'];
    let canEnter = false;
    
    // if(haveSubcription) {
    //     if(isSubcribed && DuedateToday == false) {
    //         canEnter = true;
    //     }
    // }

    if(haveSubcription) {
        if(isSubcribed) {
            canEnter = true;
        }

        if(DueDate && DuedateToday) {
            canEnter = false;
        } else {
            canEnter = true;
        }
    }
    //console.log(nextMiddle, 'before if subcription');
    if(canEnter) {
        return next(true); 
    } else {
        return router.push({name: 'Employeer-Subcription'});
    }

}