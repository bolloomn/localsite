<template>
    <div>
        <div :class="['tree-node', { 'empty-node': amIEmptyNode }]"
             :draggable="amIEmptyNode ? undefined : true"
             @dragstart.stop="handleDragStart"
             @dragenter.stop="handleDragEnter"
             @dragover.stop="handleDragOver"
             @drop.stop="handleDrop"
             @dragleave.stop="handleDragLeave"
             @dragend.stop="handleDragEnd">
            <template v-if="amIEmptyNode===false">
                <div  class="tree-content">
                    <div  v-if="vmIdx" class="columns ">
                        <div class="column is-1 has-text-centered">
                            <span style="cursor: move;" class="button">
                                <span class="icon is-small">
                                    <i class="fas fa-arrows-alt"></i>
                                </span>
                            </span>
                        </div>
                        <div class="column is-9">
                            <input type="text" v-model="data.name" class="input"/>
                        </div>
                        <div  class="column is-2 has-text-right">
                             <span @click="configmodal=true" class="button">
                                <span class="icon is-small">
                                    <i class="fas fa-cog"></i>
                                </span>
                            </span>
                             <span @click="deletemodal=true" class="button">
                                <span class="icon is-small">
                                    <i class="fas fa-trash"></i>
                                </span>
                            </span>
                        </div>
                    </div>
                    <div v-else class="boxed-item-center title" >{{data.name}}</div>
                </div>
            </template>
            <div v-if="displayedChildren.length" class="tree-node-children">
                <tree-node
                        v-for="(child, idx) in displayedChildren"
                        :data="child"
                        :shared="shared"
                        :vm-idx="idx">
                </tree-node>
            </div>
        </div>
        <!-- Delete modal -->
        <div class="modal is-active" v-if="deletemodal">
            <div class="modal-background" v-on:click="deletemodal = false"></div>
            <div class="modal-card modal-card-small">
                <header class="modal-card-head">
                    <p class="modal-card-title">Цэс устгах</p>
                </header>
                <section class="modal-card-body">
                    <p class="has-text-centered">Та итгэлтэй байна уу?</p>
                </section>
                <footer class="modal-card-foot">
                    <button class="button is-text" v-on:click="deletemodal = false">Буцах</button>
                    <button class="button is-danger add_button" v-on:click="remove() deletemodal = false">
                        <span>Устгах</span>
                    </button>
                </footer>
            </div>
        </div>


        <!-- config modal -->
        <div class="modal is-active" v-if="configmodal">
            <div class="modal-background" v-on:click="configmodal = false"></div>
            <div class="modal-card ">
                <header class="modal-card-head">
                    <p class="modal-card-title">{{data.name}}</p>
                </header>
                <section class="modal-card-body">
                    <div class="field">
                        <label class="label">Нэр</label>
                        <div class="control">
                            <input type="text"  v-model="data.name" class="input"  />
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Төрөл</label>
                        <div class="control">
                            <div class="select">
                                <select  v-model="data.type" v-on:change="changeType">
                                    <option value="0">Линк</option>
                                    <option value="1">Мэдээ</option>
                                    <option value="2">Мэдээний ангилал</option>
                                    <option value="3">Хуудас</option>
                                    <option value="4">Файлын ангилал</option>
                                    <option value="5">Файл</option>
                                    <option value="6">Холбоос ангилал</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div v-if="data.type==0" class="field">
                        <label class="label">Линк</label>
                        <div class="control">
                            <input type="text"  v-model="data.link" class="input"  />
                        </div>
                    </div>
                    <div v-else class="field">
                        <label class="label">Сонгох</label>
                                <treeselect v-model="data.type_id" placeholder="сонгох"  :default-expand-level="10"  :options="types" />
                    </div>

                    <div class="field">
                        <label class="label">Шинэ цонхонд харуулах</label>
                        <div class="control">
                            <div class="select">
                                <select  v-model="data.blank">
                                    <option value="0">Үгүй</option>
                                    <option value="1">Тийм</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </section>
                <footer class="modal-card-foot">

                    <button class="button is-primary add_button" @click="configmodal = false" >
                        <span>өөрчлөх</span>
                    </button>
                </footer>
            </div>
        </div>
    </div>


</template>
<script>
    export default {
        name: 'TreeNode', // as a recursive component
        props: {
            data: { type: Object, required: true }, // { label: String, children: [{ label, children }] } or an empty object
            shared: { type: Object, default: () => ({/* draggingVm: VueInstance */}) }, // shared data for all the instances
            vmIdx: Number // current instance's index in v-for (if exists)
        },
        data() {
            return {
                deletemodal:false,
                configmodal:false,
                selected_type: null,
                types:[],
            }
        },
        computed: {
            configSave() {
                // if(this.data.name==''){
                //     alert('Цэсний нэр оруулна уу !!!')
                //     return
                // }
                //
                // if(this.data.type==0){
                //     if(this.data.link.length==0){
                //         alert('Линк оруулна уу !!!')
                //     }
                //     return
                // } else {
                //    if(this.data.type_id==null){
                //        alert('Сонгох талбараас сонгоно уу !!!')
                //        return
                //    }
                // }
                this.configmodal = false;
            },

            changeType(){
                this.data.type_id=null;

                if(this.data.type==1){
                    axios.get('/news_select/' + this.data.site_id).then((response) => {
                        this.types = response.data.success;
                    });
                    return
                }

                if(this.data.type==2){
                    axios.get('/news_category/' + this.data.site_id).then((response) => {
                        this.types = response.data.success;
                    });
                    return
                }

                if(this.data.type==3){
                    axios.get('/page_select/' + this.data.site_id).then((response) => {
                        this.types = response.data.success;
                    });
                    return
                }


                if(this.data.type==4){
                    axios.get('/file_category/'+ this.data.site_id).then((response) => {
                        this.types = response.data.success;
                    });
                    return
                }


                if(this.data.type==5){
                    axios.get('/file_select/'+ this.data.site_id).then((response) => {
                        this.types = response.data.success;
                    });
                    return
                }

                if(this.data.type==6){
                    axios.get('/link_category_show/'+this.data.site_id).then((response) => {
                        this.types = response.data.success;
                    });
                    return
                }


            },
            amIEmptyNode () {
                // data of an empty node is an empty object: {}
                 return !this.data.id
            },
            /**
             * Generate adjacent empty nodes for each real node, in order to implement insertion actions
             * e.g. [R1, R2, R3] === displayed as ===> [E1, R1, E2, R2, E3, R3, E4]
             * (R means Real node, E means Empty node)
             */
            displayedChildren () {
                const realNodes = this.data.children;
                if (!realNodes || !realNodes.length) return []; // an empty node or a real node without children
                return realNodes.reduce((displayedChildren, realNode) => {
                    displayedChildren.push(realNode, {}/* <--- empty node */);
                    return displayedChildren
                }, [{}])
            }
        },
        methods: {
            /**
             * @context {this} - instance of drop-into node
             */
            isAllowedToDrop () {
                let vm = this;
                const { draggingVm } = vm.shared;
                // limitation 1: this cannot be the parent of the dragging node
                if (vm === draggingVm.$parent) {
                    return false
                }
                // limitation 2: this cannot be the adjacent empty node of the dragging node
                if (vm.$parent === draggingVm.$parent && Math.abs(vm.vmIdx - draggingVm.vmIdx) === 1) {
                    return false
                }
                // limitation 3: this cannot be the dragging node itself or its descendant
                while (vm) {
                    if (vm === draggingVm) return false;
                    vm = vm.$parent.$options.name === 'TreeNode' ? vm.$parent : null
                }
                return true
            },
            /**
             * @context {this} - instance of dragging node
             */
            handleDragStart () {
                // this.shared.draggingVm = this // cannot ensure reactive
                this.$set(this.shared, 'draggingVm', this); // ensure reactive
                this.$el.classList.add('dragging-node')
            },
            /**
             * @context {this} - instance of drop-into node
             */
            handleDragEnter () {
                this.$el.classList.add(this.isAllowedToDrop() ? 'drop-allowed' : 'drop-not-allowed')
            },
            /**
             * @context {this} - instance of drop-into node
             * Note that this function invokes once per every few hundred milliseconds
             */
            handleDragOver (e) {
                e.preventDefault(); // must!!!
                e.dataTransfer.dropEffect = this.isAllowedToDrop() ? 'move' : 'none'
            },
            /**
             * @context {this} - instance of drop-into node
             */
            remove(){
                const { draggingVm } = this.shared;
                this.$parent.data.children.splice(this.vmIdx / 2, 1)
            },


            handleDrop () {
                this.revertClass();
                if (!this.isAllowedToDrop()) return;
                const { draggingVm } = this.shared;
                // remove from the original place
                const realIdxOfOrigin = (draggingVm.vmIdx - 1) / 2;
                draggingVm.$parent.data.children.splice(realIdxOfOrigin, 1);
                // case 1: drop into an empty node
                if (this.amIEmptyNode) {
                    this.$parent.data.children.splice(this.vmIdx / 2, 0, draggingVm.data);
                    return
                }
                // case 2: drop into a real node as its child
                if (!this.data.children) {
                    this.$set(this.data, 'children', []) // ensure reactive
                }
                this.data.children.push(draggingVm.data)
            },
            /**
             * @context {this} - instance of drop-into node
             */
            handleDragLeave () {
                this.revertClass()
            },
            /**
             * @context {this} - instance of dragging node
             */
            handleDragEnd () {
                this.shared.draggingVm = null;
                this.$el.classList.remove('dragging-node')
            },
            revertClass () {
                this.$el.classList.remove('drop-allowed', 'drop-not-allowed')
            }
        }
    }
</script>
<style>
    .tree-node {
        display: list-item;
        padding-left: 2px;
        list-style: none;
        line-height: 20px;
        border-left: 1px dashed #ddd;
        transition: height .5s ease;
    }
    .empty-node {
        height: 10px;
    }
    .tree-node-children {
        margin-left: 20px; /* indention */
    }
    .dragging-node {
        color: orange;
        opacity: 0.7;
    }
    .drop-allowed {
        height: 30px;
        border: 1px dashed #ddd;
        border-radius: 5px;
        background-color: yellow;
    }
    .drop-not-allowed {
        opacity: 0.7;
    }
    .tree-content {
        background:#FFF;
        padding:0.5em;
        margin-left: 10px;
    }
    .boxed-item-center.title {
        font-size: 1.75rem;
        font-weight: 400;
        text-transform: uppercase;
        letter-spacing: 4px;
        margin-bottom: 0; padding:0.5em
    }
</style>
