<template>
    <div v-if="post" class="bcarousel" :class="color">

        <h3 class="bTitle">{{title}}</h3>
        <carousel
                :per-page="currentPage"
                :navigationEnabled="true"
                :paginationEnabled="false"
                navigationNextLabel="<i class='fas fa-angle-right'></i>"
                navigationPrevLabel="<i class='fas fa-angle-left'></i>"
        >
            <template v-for="p in post">
                <slide>
                    <div class="bcarousel-list">
                        <b-img classes="bcarousel-list" :value="p" size="medium">
                        <a target="_blank" :href="'http://'+p.domain+'.'+subdomain+'/news/'+p.id">
                            <div  class="CarTitle roboto-condensed ">
                                <span class="tag">{{p.site}}</span><br>
                                {{p.title.substring(0, 50)}}<span v-if="p.title.length>50">...</span>
                            </div>
                        </a>
                        </b-img>
                    </div>
                </slide>
            </template>
        </carousel>
    </div>
    <loading v-else></loading>

</template>

<script>
    export default {
        props:[
            'page',
            'color',
            'title',
        ],
        data(){
            return {
                siteUrl: window.surl,
                subdomain: window.subdomain,
                currentPage: this.page,
                window: {
                    width: 0,
                    height: 0
                },
                post:false
            }
        },
        created: function () {
            window.addEventListener('resize', this.handleResize);
            this.handleResize();
            this.fetchData();
            },
        destroyed() {
            window.removeEventListener('resize', this.handleResize)
        },
        methods: {
            handleResize() {
                this.window.width = window.innerWidth;
                this.window.height = window.innerHeight;

                if(this.window.width>=600){
                    this.currentPage= this.page;
                } else {
                    this.currentPage= 2;
                }

            },
            fetchData: function () {
                axios.get('/oronnutag/6').then((response) => {
                    this.post=response.data.success.data;
                })
            },
        }
    }
</script>
