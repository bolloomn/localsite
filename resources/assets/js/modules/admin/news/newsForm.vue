<!--

CRUD Edit, Create form

 -->

<template>
    <div>

        <div  class="modal is-active">
            <div class="modal-background"></div>
            <div class="modal-card modal-card-full">
                <header class="modal-card-head">
                    <p v-if="m_id" class="modal-card-title">Мэдээ засах</p>
                    <p v-else class="modal-card-title">Мэдээ нэмэх</p>
                </header>

                <section class="modal-card-body" v-if="fetched">
                    <form @submit.prevent="nemeh">

                        <div class="columns is-mobile is-multiline">


                            <div class="column is-12-mobile is-4-tablet is-3-desktop">

                                <div class="field">
                                    <label class="label">Төрөл</label>
                                    <div class="control select">
                                        <select class="input" name="type"  v-model="form.type" >
                                            <option value="0">мэдээ</option>
                                            <option value="1">фото</option>
                                            <option value="2">видео</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="field" v-if="form.type!=2">
                                    <label class="label">Зураг</label>
                                    <div class="control has-image">
                                        <div class="file is-boxed is-fullwidth">
                                            <label class="file-label">
                                                <input class="file-input" type="file" accept="image/*" name="imageni" @change="onFileChange($event.target.name, $event.target.files)">
                                                <span class="file-cta" >
                                                <span v-if="imageni" class="file-icon" :style="'background-image: url('+imageni+');'">
                                                    <i class="ion-ios-add-outline"></i>
                                                </span>
                                                <span v-else="" class="file-icon no-background">
                                                    <i class="ion-ios-add-outline"></i>
                                                </span>
                                            </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="field" v-else="">
                                    <label class="label">Youtube код <span class="has-text-danger">*</span></label><small style="margin-top:10px;">https://www.youtube.com/watch?v=<span class="has-text-success">6XaaI4_nIHY</span></small>
                                    <div class="control">
                                        <input type="text" name="youtube" v-validate="'required'" v-model="form.youtube" :class="{'input': true, 'is-danger': errors.has('youtube') }" />
                                        <p v-show="errors.has('youtube')" class="help is-danger">Та youbute кодоо оруулна уу</p>
                                    </div>
                                </div>


                                <div class="field">
                                    <label class="label">Ангилал <span class="has-text-danger">*</span></label>
                                        <treeselect v-validate="'required'" name="cat_id" v-model="form.cat_id" :flat="true"  :default-expand-level="10" placeholder="Ангилал сонгох" :multiple="true" :options="options" />
                                        <p v-show="errors.has('cat_id')" class="help is-danger">Та ангилал сонгоно уу</p>
                                </div>

                                <div class="field">
                                    <label class="label">Нийтлэх дэд сайтууд</label>
                                    <treeselect v-model="form.sites" :flat="true"  :default-expand-level="10" placeholder="Нийтлэх дэд сайтууд сонгох" :multiple="true" :options="sites" />
                                </div>

                                <div class="field">
                                    <label class="label">Онцлох мэдээ</label>
                                    <div class="control select">
                                        <select  v-model="form.is_primary"  >
                                            <option value="0">үгүй</option>
                                            <option value="1">тийм</option>
                                        </select>
                                    </div>
                                </div>



                                <div class="field">
                                    <label class="label">Төлөв</label>
                                    <div class="control select">
                                        <select class="input" name="status"  v-model="form.status" >
                                            <option value="1">Нийтлэсэн</option>
                                            <option value="0">Ноорог</option>
                                        </select>
                                    </div>
                                </div>



                            </div>
                            <div class="column is-12-mobile is-8-tablet is-9-desktop">
                                <div class="field">
                                    <label class="label">Гарчиг <span class="has-text-danger">*</span></label>
                                    <div class="control">
                                        <input type="text" name="title"  v-validate="{'required':true, 'min':3}" v-model="form.title" :class="{'input': true, 'is-danger': errors.has('title') }" />
                                        <p v-show="errors.has('title')" class="help is-danger">Заавал бөглө, хамгийн багадаа 3 тэмдэгт байна.</p>
                                    </div>
                                </div>

                                <div class="field">
                                    <label class="label">Товч текст <span v-if="form.type!=2" class="has-text-danger">*</span></label>
                                        <template v-if="form.type!=2">
                                            <textarea   v-validate="{'required':true, 'min':3}"  style="min-height: 80px; "  class="textarea" name="short_content" v-model="form.short_content" ></textarea>
                                            <p v-show="errors.has('short_content')" class="help is-danger">Заавал бөглө, хамгийн багадаа 3 тэмдэгт байна.</p>
                                        </template>
                                        <template v-else>
                                            <textarea  style="min-height: 80px; "  class="textarea" name="short_content" v-model="form.short_content" ></textarea>
                                        </template>
                                </div>

                                <div class="field">
                                    <label class="label">Дэлгэрэнгүй мэдээлэл <span v-if="form.type!=2" class="has-text-danger">*</span></label>
                                    <div class="control has-autoblock">
                                        <template v-if="form.type!=2">
                                            <Tinymce v-validate="{'required':true}"  v-model="form.content"  height="400" ></Tinymce>
                                            <p v-show="errors.has('content')" class="help is-danger">Заавал бөглө</p>
                                        </template>
                                        <template v-else>
                                            <Tinymce v-model="form.content"  height="400"  ></Tinymce>
                                        </template>
                                    </div>
                                </div>
                            </div>




                        </div>
                    </form>
                </section>
                <div v-else class="main-bodoh is-loading"></div>

                <footer class="modal-card-foot">
                    <a class="button is-text" v-on:click="butsah">{{$store.getters.lang.messages.is_back_button}}</a>
                    <button @click="nemeh" class="button is-primary add_button has-text-weight-semibold" :class="{'is-loading':is_loading}" :disabled="is_loading || fetched === false">
                        <span>{{$store.getters.lang.messages.is_save_button}}</span>
                    </button>
                </footer>
            </div>
        </div>

    </div>
</template>

<script>

    export default {
        data(){
            return {
                options: [],
                siteUrl: window.surl,			// Edit үед id орж ирнэ
                fetched: false,
                site_id: this.$store.getters.domain.id,
                is_loading: false,
                m_id: false,
                sites:[],
                imageni:false,
                image: [],
                file: [],
                form:{
                    title: '',
                    content: '',
                    youtube: '',
                    short_content: '',
                    type: 0,
                    status: 1,
                    is_primary: 0,
                    cat_id: [],
                    sites:[],
                    main_site_publish:0,
                    admin_id: this.$store.getters.authUser.id,
                    site_id: this.$store.getters.domain.id,
                },
                aldaanuud: [],
            }
        },
        created: function () {
            this.fetchData();
        },
        computed: {
        },
        methods: {
            fetchData() {
                this.m_id = this.$route.params.id;
                axios.get('/news_category/'+this.site_id).then((response) => {
                    this.options = response.data.success;

                });

                axios.get('/site').then((response) => {
                    this.sites.push({ id:0, name:'Бүх дэд сайтад',  label:'Бүх дэд сайтад',  text:'Бүх дэд сайтад'});
                    for(var i=0; i<response.data.success.length; i++){
                        this.sites.push(response.data.success[i]);
                    }

                });
                if (this.m_id) {
                    axios.get('/news/'+this.m_id).then((response) => {
                        // console.log( response.data.success);
                        this.form.title = response.data.success.title;
                        this.form.content = response.data.success.content;
                        this.form.short_content = response.data.success.short_content;
                        this.form.type = response.data.success.type;
                        if( this.form.type ==2){ this.form.youtube=response.data.success.image; }
                        this.form.status = response.data.success.status;
                        this.form.is_primary = response.data.success.is_primary;
                        this.form.cat_id = response.data.success.category;
                        this.form.sites = response.data.success.site;

                        if (response.data.success.image) {
                            this.imageni = this.siteUrl+'/uploads/'+response.data.success.image.replace('images/', 'medium/');
                        }

                        this.fetched = true;
                    })
                } else {
                    this.fetched = true;
                }
            },
            // Back
            butsah: function() {
                return this.$nextTick(() => this.$router.back(-1))
            },
            // Нэмэх, Засах
            nemeh: function() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        this.is_loading = true;
                        let formData = new FormData();

                        formData.append('data', JSON.stringify(this.form));
                        formData.append('image', this.image);
                        // Create
                        if (this.m_id) {
                            axios.post('/news/'+this.m_id, formData)
                                .then((response) => {
                                     this.$router.push('/news');
                                    this.$toasted.global.toast_success({message: this.$store.getters.lang.messages.is_created_text});
                                });
                        } else {
                            axios.post('/news', formData)
                                .then((response) => {
                                     this.$router.push('/news');
                                    this.$toasted.global.toast_success({message: this.$store.getters.lang.messages.is_created_text});
                                });
                        }
                    }
                });
            },

            onFileChange(fieldName, fileList){
                const formData = new FormData();
                // append the files to FormData
                Array
                    .from(Array(fileList.length).keys())
                    .map(x => {
                        formData.append(fieldName, fileList[x], fileList[x].name);
                    });

                this.image = formData.get(fieldName);


                let reader = new FileReader();
                reader.addEventListener("load", (e) => {
                    this.imageni = reader.result;
                });
                reader.readAsDataURL(fileList[0]);
            },
        }
    }
</script>
