<template>
    <div>
        <div class="section">
            <div class="columns is-centered">
                <div class="column is-10">
                    <div class="box">

                        <div class="is-flex is-justify-content-center mb-2" style="font-size: 20px; font-weight: bold;">FACULTY</div>

                        <div class="level">
                            <div class="level-left">
                                <b-field label="Page">
                                    <b-select v-model="perPage" @input="setPerPage">
                                        <option value="5">5 per page</option>
                                        <option value="10">10 per page</option>
                                        <option value="15">15 per page</option>
                                        <option value="20">20 per page</option>
                                    </b-select>
                                    <b-select v-model="sortOrder" @input="loadAsyncData">
                                        <option value="asc">ASC</option>
                                        <option value="desc">DESC</option>

                                    </b-select>
                                </b-field>
                            </div>

                            <div class="level-right">
                                <div class="level-item">
                                    <b-field label="Search">
                                        <b-input type="text"
                                                 v-model="search.course" placeholder="Search Course"
                                                 @keyup.native.enter="loadAsyncData"/>
                                        <p class="control">
                                             <b-tooltip label="Search" type="is-success">
                                            <b-button type="is-primary" icon-right="account-filter" @click="loadAsyncData"/>
                                             </b-tooltip>
                                        </p>
                                    </b-field>
                                </div>
                            </div>
                        </div>

                        <b-table
                            :data="data"
                            :loading="loading"
                            paginated
                            detailed
                            backend-pagination
                            :total="total"
                            :bordered="true"
                            :hoverable="true"
                            :per-page="perPage"
                            @page-change="onPageChange"
                            aria-next-label="Next page"
                            aria-previous-label="Previous page"
                            aria-page-label="Page"
                            aria-current-label="Current page"
                            backend-sorting
                            :default-sort-direction="defaultSortDirection"
                            @sort="onSort">

                            <b-table-column field="user_id" label="ID" v-slot="props">
                                {{ props.row.user_id }}
                            </b-table-column>

                            <b-table-column field="name" label="Name" v-slot="props">
                                {{ props.row.lname }}, {{ props.row.fname }} {{ props.row.mname }}
                            </b-table-column>

                            <b-table-column field="sex" label="Sex" v-slot="props">
                                {{ props.row.sex }}
                            </b-table-column>

                            <b-table-column field="civil_status" label="Status" v-slot="props">
                                {{ props.row.civil_status }}
                            </b-table-column>

                            <b-table-column label="Action" v-slot="props">
                                <div class="is-flex">

                                    <modal-browse-schedules
                                        :prop-course="courseName"
                                        :prop-academicyears="acadyears"
                                        @browseSchedule="emitBrowseSchedule">
                                    </modal-browse-schedules>
                
                                    <!-- <b-dropdown aria-role="list">
                                        <template #trigger="{ active }">
                                            <b-button
                                                label=""
                                                type="is-primary"
                                                class="is-outliend is-small"
                                                :icon-right="active ? 'menu-up' : 'menu-down'" />
                                        </template>

                                        <b-dropdown-item @click="getData(props.row.faculty_load_id)"
                                            aria-role="listitem">Reset Password</b-dropdown-item>

                                        <b-dropdown-item 
                                            @click="addLoad(props.row.user_id)" 
                                            aria-role="listitem">Add Load</b-dropdown-item>

                                        <b-dropdown-item 
                                            @click="deactivateAccount(props.row.user_id)" 
                                            aria-role="listitem">Deactivate</b-dropdown-item>
                                    </b-dropdown> -->
                                </div>
                            </b-table-column>

                            <template #detail="props">
                                <tr>
                                    <td>Program Description</td>
                                    <td>Faculty Assigned</td>
                                </tr>
                                <tr v-if="props.row.faculty">
                                    <td>{{ props.row.program.program_desc }}</td>
                                    <td>
                                        <span>
                                            {{ props.row.faculty.fname }} {{ props.row.faculty.mname }} {{ props.row.faculty.lname }}
                                        </span>
                                    </td>
                                </tr>
                            </template>

                        </b-table>

                        <div class="buttons mt-3">
                            <b-button @click="openModal" icon-right="calendar" class="is-success">NEW</b-button>
                        </div>

                    </div>
                </div><!--col -->
            </div><!-- cols -->
        </div><!--section div-->



        <!--modal create-->
        <b-modal v-model="isModalCreate" has-modal-card
                 trap-focus
                 :width="640"
                 aria-role="dialog"
                 aria-label="Modal"
                 aria-modal>

            <form @submit.prevent="submit">
                <div class="modal-card">
                    <header class="modal-card-head">
                        <p class="modal-card-title">COURSES</p>
                        <button
                            type="button"
                            class="delete"
                            @click="isModalCreate = false"/>
                    </header>

                    <section class="modal-card-body">
                        <div class="">
                            <div class="columns">
                                <div class="column">
                                    <b-field label="Course Code" label-position="on-border"
                                            :type="this.errors.course_code ? 'is-danger':''"
                                            :message="this.errors.course_code ? this.errors.course_code[0] : ''">
                                        <b-input v-model="fields.course_code"
                                                 placeholder="Course Code" required>
                                        </b-input>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Course Description" label-position="on-border"
                                        :type="this.errors.course_desc ? 'is-danger':''"
                                        :message="this.errors.course_desc ? this.errors.course_desc[0] : ''">
                                        <b-input v-model="fields.course_desc"
                                            placeholder="Course Description" required>
                                        </b-input>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Course Type" expanded label-position="on-border"
                                        :type="this.errors.course_type ? 'is-danger':''"
                                        :message="this.errors.course_type ? this.errors.course_type[0] : ''">
                                        <b-select v-model="fields.course_type" expanded
                                            placeholder="Course Type" required>
                                            <option value="LEC">LEC</option>
                                            <option value="LAB">LAB</option>
                                        </b-select>
                                    </b-field>
                                </div>

                                <div class="column">
                                    <b-field label="Course Unit" label-position="on-border"
                                        :type="this.errors.course_unit ? 'is-danger':''"
                                        :message="this.errors.course_unit ? this.errors.course_unit[0] : ''">
                                        <b-numberinput v-model="fields.course_unit"
                                            placeholder="Course Unit" required :controls="false">
                                        </b-numberinput>
                                    </b-field>
                                </div>
                            </div>

                        </div>
                    </section>
                    <footer class="modal-card-foot">
                        <button
                            :class="btnClass"
                            label="Save"
                            type="is-success">SAVE</button>
                    </footer>
                </div>
            </form><!--close form-->
        </b-modal>
        <!--close modal-->


    </div>
</template>

<script>

export default{
    data() {
        return{
            data: [],
            total: 0,
            loading: false,
            sortField: 'lname',
            sortOrder: 'asc',
            page: 1,
            perPage: 20,
            defaultSortDirection: 'asc',

            acadyears: [],


            global_id : 0,

            search: {
                course: '',
                ayid: 0,
            },

            isModalCreate: false,

            fields: {},

            courseName: '',

            errors: {},
            

            btnClass: {
                'is-success': true,
                'button': true,
                'is-loading':false,
            },
        }

    },

    methods: {
        /*
        * Load async data
        */
        loadAsyncData() {
            const params = [
                `sort_by=${this.sortField}.${this.sortOrder}`,
                `course=${this.search.course}`,
                `perpage=${this.perPage}`,
                `page=${this.page}`
            ].join('&')

            this.loading = true
            axios.get(`/get-faculty-loads?${params}`)
                .then(({ data }) => {
                    this.data = [];
                    let currentTotal = data.total
                    if (data.total / this.perPage > 1000) {
                        currentTotal = this.perPage * 1000
                    }

                    this.total = currentTotal
                    data.data.forEach((item) => {
                        //item.release_date = item.release_date ? item.release_date.replace(/-/g, '/') : null
                        this.data.push(item)
                    })
                    this.loading = false
                })
                .catch((error) => {
                    this.data = []
                    this.total = 0
                    this.loading = false
                    throw error
                })
        },
        /*
        * Handle page-change event
        */
        onPageChange(page) {
            this.page = page
            this.loadAsyncData()
        },

        onSort(field, order) {
            this.sortField = field
            this.sortOrder = order
            this.loadAsyncData()
        },

        setPerPage(){
            this.loadAsyncData()
        },

        openModal(){
            this.isModalCreate=true;
            this.clearFields()
            this.errors = {};
        },

        loadAcadYears(){
            axios.get('/load-acadyears').then(res=>{
                this.acadyears = res.data
                console.log(this.acadyears)
            })
        },

        submit: function(){

            if(this.global_id > 0){
                //update
                axios.put('/faculty-loads/'+this.global_id, this.fields).then(res=>{
                    if(res.data.status === 'updated'){
                        this.$buefy.dialog.alert({
                            title: 'UPDATED!',
                            message: 'Successfully updated.',
                            type: 'is-success',
                            onConfirm: () => {
                                this.loadAsyncData();
                                this.clearFields();
                                this.global_id = 0;
                                this.isModalCreate = false;
                            }
                        })
                    }
                }).catch(err=>{
                    if(err.response.status === 422){
                        this.errors = err.response.data.errors;
                    }
                })
            }else{
                //INSERT HERE
                axios.post('/faculty-loads', this.fields).then(res=>{
                    if(res.data.status === 'saved'){
                        this.$buefy.dialog.alert({
                            title: 'SAVED!',
                            message: 'Successfully saved.',
                            type: 'is-success',
                            confirmText: 'OK',
                            onConfirm: () => {
                                this.isModalCreate = false;
                                this.loadAsyncData();
                                this.clearFields();
                                this.global_id = 0;
                            }
                        })
                    }
                }).catch(err=>{
                    if(err.response.status === 422){
                        this.errors = err.response.data.errors;
                    }
                });
            }
        },


        //alert box ask for deletion
        confirmDelete(delete_id) {
            this.$buefy.dialog.confirm({
                title: 'DELETE!',
                type: 'is-danger',
                message: 'Are you sure you want to delete this data?',
                cancelText: 'Cancel',
                confirmText: 'Delete',
                onConfirm: () => this.deleteSubmit(delete_id)
            });
        },
        //execute delete after confirming
        deleteSubmit(delete_id) {
            axios.delete('/faculty-loads/' + delete_id).then(res => {
                this.loadAsyncData();
            }).catch(err => {
                if (err.response.status === 422) {
                    this.errors = err.response.data.errors;
                }
            });
        },

        clearFields(){
            this.global_id = 0;
            this.fields.user_id = null;
            this.fields.academic_year = null;
            this.fields.schedule_id = null;
        },


        //update code here
        getData: function(data_id){
            this.clearFields();
            this.global_id = data_id;
            this.isModalCreate = true;

            axios.get('/faculty-loads/'+data_id).then(res=>{
                this.fields = res.data;
               
                
            });
        },

        emitBrowseSchedule(row){
            console.log('row from emit: ', row)
        }

    },

    mounted() {
        this.loadAsyncData();
        this.loadAcadYears();

    }
}
</script>


<style>


</style>
