<template>
<!--<div  v-if="fetched" >-->
        <!--<div class="catTitle">Мэдээний ангилал</div>-->
        <!--<p class="buttons mr0">-->
            <!--<a  class="button is-primary" @click="save()" :class="{'is-loading':is_loading}" :disabled="is_loading">-->
                <!--<span class="icon"><i class="fas fa-save"></i></span><span>Хадгалах</span>-->
            <!--</a>-->
            <!--<a  class="button" @click="add()">-->
                <!--<span class="icon"><i class="fas fa-plus"></i></span><span>Aнгилал нэмэх</span>-->
            <!--</a>-->
        <!--</p>-->
        <!--<div class="columns">-->
            <!--<div class="column is-12-tablet is-12-mobile">-->
                <!--<tree-node :data="treeData" ></tree-node>-->
            <!--</div>-->
        <!--</div>-->
<!--</div>-->

</template>
<script>
    // import TreeNode from '../../../components/helpers/treeMenu'
    // export default {
    //     components: { TreeNode },
    //     data: () => ({
    //         fetched:false,
    //         is_loading:false,
    //         site_id:0,
    //         treeData: {
    //             name: 'Цэс',
    //             children: []
    //         },
    //
    //     }),
    //     created: function () {
    //         this.fetchData();
    //     },
    //     methods: {
    //         // api url-аас дата авч байна
    //         fetchData() {
    //             this.site_id=this.$store.getters.domain.id;
    //             axios.get('/menu/'+this.$store.getters.domain.id).then((response) => {
    //                 if(response.data.success){  this.treeData.children = response.data.success; }
    //                 console.log(this.treeData);
    //                 this.fetched = true;
    //             })
    //         },
    //
    //         save(){
    //             this.is_loading=true;
    //             let formData = new FormData();
    //             formData.append('data', JSON.stringify(this.treeData.children));
    //
    //             axios.post('/menu_save/'+this.site_id, formData)
    //                 .then((response) => {
    //                     this.is_loading = false;
    //                     this.fetchData();
    //                     this.$toasted.global.toast_success({message: this.$store.getters.lang.messages.is_updated_text});
    //                 });
    //         },
    //
    //         add(){
    //           this.treeData.children.unshift({id:-1, name:"", type:0, link:"", type_id: null, blank:0  })
    //         }
    //
    //     }
    // }
</script>