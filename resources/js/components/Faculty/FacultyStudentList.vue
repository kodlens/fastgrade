<template>
    <div>
        <div>
            <p class="has-text-weight-bold mb-4 has-text-centered title is-5">STUDENT LIST</p>
        </div>

        <div class="columns">
            <div class="column">
                <b-field label="Select Academic Year">
                    <b-input v-model="search.name" type="text" placeholder="Student Name"></b-input>
                    <p class="control">
                        <b-button @click="loadStudentList"
                            label="" icon-left="magnify" 
                            type="is-info"></b-button>
                    </p>
                </b-field>
            </div>
        </div>
        <hr>
        <div class="columns">
            <div class="column">
                <table class="faculty-load">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Program & Year</th>
                        <th>Action</th>

                    </tr>

                    <tr v-for="(item, idx) in data" :key="`i${idx}`">
                        <td>{{ item.student.user_id }}</td>
                        <td>{{ item.student.lname }}, {{ item.student.lname }} {{ item.student.mname }}</td>
                        <td>{{ item.student.program.program_code }}</td>

                         <td>
                            <b-button type="is-danger" 
                                @click="confirmRemoveStudent(item.student_list_id)"
                                icon-left="delete" class="is-small is-outlined"></b-button>
                        </td>
                    </tr>
                </table>

                <div class="mt-4">
                    <modal-browse-students
                        @browseStudents="emitBrowseStudents"></modal-browse-students>
                </div>
            </div>
        </div>
    </div>    
</template>

<script>

export default{

    props: ['propScheduleId', 'propFacultyId'],

    data() {
        return{

            data: [],

            search: {
                name: '',
            }

        }
    },

    methods: {
        

        loadStudentList(){
            const params = [
                `sid=${this.propScheduleId}`,
                `fid=${this.propFacultyId}`,
                `name=${this.search.name}`,
            ].join('&')
            axios.get(`/get-student-lists?${params}`).then(res=>{
                this.data = res.data
                console.log(res.data)
            })
        },

        studentList(id, fid){

            window.location = '/faculty-student-list/' + id + '/' + fid;
        },

        emitBrowseStudents(row){
            console.log(row)

            let fields = {
                schedule_id: this.propScheduleId,
                faculty_id: this.propFacultyId,
                student_id: row.user_id
            };
             
            axios.post('/faculty-student-list-store', fields).then(res=>{
                if(res.data.status === 'saved'){
                    this.$buefy.dialog.alert({
                        title: 'Added.',
                        message: 'Successfully added.',
                        type: 'is-info',
                        onConfirm: ()=> {
                            this.loadStudentList()
                        }
                    })
                }
            }).catch(err=>{
                this.errors = err.response.data.errors

                if(this.errors.exist){
                    this.$buefy.dialog.alert({
                        title: 'Exist.',
                        message: this.errors.exist[0],
                        type: 'is-danger'
                    })
                }
            })
        },


        confirmRemoveStudent(id){
            this.$buefy.dialog.confirm({
                title: 'Remove?',
                message: 'Are you sure you want to remove this student from the list?',
                type: 'is-info',
                onConfirm: () => {
                    this.removeSubmitStudent(id)
                }
            })
        },
        removeSubmitStudent(id){
            axios.delete('/faculty-student-list/' + id).then(res=>{
                if(res.data.status === 'deleted'){
                    this.$buefy.dialog.alert({
                        title: 'Deleted.',
                        message: 'Data deleted successfully.',
                        type: 'is-success'
                    })

                    this.loadStudentList()
                }
            })
        }
    },
    mounted(){
        this.loadStudentList()
    }
}
</script>


<style scoped>
.faculty-load{
    width: 100%;
}
.faculty-load th{
    padding: 15px;
    border-bottom: 1px solid rgb(189, 189, 189);
}

.faculty-load tr td{
    padding: 5px 15px;
}
</style>