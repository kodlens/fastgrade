<template>
    <div>
        <div>
            <p class="has-text-weight-bold mb-4 has-text-centered title is-5">MY COURSES</p>
        </div>

        <div class="columns">
            <div class="column">
                <b-field label="Search Course">
                    <b-input v-model="search.course" type="text" placeholder="Search Course"></b-input>
                    <p class="control">
                        <b-button @click="loadMyCourses"
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
                        <th>Course</th>
                        <th>Schedule</th>
                        <th>Grade</th>
                    </tr>

                    <tr v-for="(item, idx) in data" :key="`i${idx}`">
                        <td>{{ item.student.user_id }}</td>
                        <td>{{ item.student.lname }}, {{ item.student.lname }} {{ item.student.mname }}</td>
                        <td>{{ item.student.program.program_code }}</td>
                        <td style="font-weight: bold; text-align:center;">
                            <span v-if="item.grade">
                                {{ item.grade.grade }}
                            </span>
                        </td>
                         <td>
                            <b-tooltip label="Remove" class="is-danger">
                                <b-button type="is-danger" 
                                    @click="confirmRemoveStudent(item.student_list_id)"
                                    icon-left="delete" class="is-small is-outlined"></b-button>
                            </b-tooltip>
                            <b-tooltip label="Grade Entry" class="is-info">
                                <b-button type="is-info" 
                                    @click="modalGradeEntry(item.student_id, item.student_list_id)"
                                    icon-left="chart-donut" class="is-small is-outlined"></b-button>
                            </b-tooltip>
                        </td>
                    </tr>
                </table>

                
            </div>
        </div>





    </div>    <!--root -->
</template>

<script>

export default{

    data() {
        return{

            data: [],

            search: {
                course: '',
            },

            fields: {}

        }
    },

    methods: {
        
        loadMyCourses(){
            const params = [
                `acadyearid=${this.propAcademicYearId}`,
                `name=${this.search.name}`,
            ].join('&')
            axios.get(`/get-my-courses?${params}`).then(res=>{
                this.data = res.data
            })
        },
    },

    mounted(){
        this.loadStudentList()
    },
    
    computed: {
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