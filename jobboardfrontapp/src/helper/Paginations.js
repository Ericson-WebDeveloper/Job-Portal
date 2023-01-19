export default class Paginations {
    constructor(n, applications, page1) {
        this.n = n;
        this.pages = [];
        this.paginates = [];
        this.applications = applications;
      
        this.applications.value.links.shift();
        this.applications.value.links.pop();

        this.page1 = page1;
   
        this.returnResults();
    }

    returnResults = () => {
        this.pages = [];
        this.paginates = [];
        this.page1.value = [];
        this.pages = this.getPages(this.applications.value.links);
        this.paginates = this.grouping(this.pages);
        this.returnPages();
       
    }

    grouping(arr) {
        let number = this.n;
        let pagination = arr.reduce((r, e, i) =>
            (i % number ? r[r.length - 1].push(e) : r.push([e])) && r
        , []);
        
        return pagination;
    }

    getPages(datas) {
        let pages = [];
            datas.forEach((element, index) => {
                pages.push(index+1);
            });
        return pages;
    }

    returnPages() {
        let p = null;
        this.paginates.forEach((arr, index) => {
            if(arr.includes(this.applications.value.current_page)) {
                p = index;
            }
        });

        Array.from(this.paginates[p]).forEach((pa) => {
            this.page1.value.push({page:pa})
        });
    }

    returnFormattedPage (arrayData, pushdata) {
        Array.from(arrayData).forEach((pa) => {
            pushdata.value.push({page:pa})
        });
    }
}