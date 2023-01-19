export default class Pagination {
    constructor(n, applications, page1, page2) {
        this.n = n;
        this.pages = [];
        this.paginates = [];
        this.applications = applications;
      
        this.applications.value.links.shift();
        this.applications.value.links.pop();

        this.page1 = page1;
        this.page2 = page2;

        this.returnResults();
    }

    returnResults = () => {
        this.pages = [];
        this.paginates = [];
        this.page1.value = [];
        this.page2.value = [];
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

        if(this.paginates[p + 2]) {
            this.returnFormattedPage(this.paginates[p + 2], this.page2);
        } else {
            if(this.paginates[p + 1]) {
                this.returnFormattedPage(this.paginates[p + 1], this.page2); 
            } else {
                if(this.paginates[p-1]) {
                    this.page1.value = [];
                    this.returnFormattedPage(this.paginates[p], this.page2);
                    this.returnFormattedPage(this.paginates[p-1], this.page1);
                } 
            }
        }
        // console.log(this.page1.value, this.page2.value)
    }

    returnFormattedPage (arrayData, pushdata) {
        Array.from(arrayData).forEach((pa) => {
            pushdata.value.push({page:pa})
        });
    }
}