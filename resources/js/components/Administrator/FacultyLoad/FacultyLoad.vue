<template>
    <div>
        <div class="section">
            <div class="columns is-centered">
                <div class="column is-8">
                    <div class="box">
                        <div class="has-text-weight-bold">MANAGE FACULTY LOAD</div>
                        <br>
                        <b-field label="Academic Year" label-position="on-border">
                            <b-select v-model="acadYear">
                                <option v-for="(item, ixx) in acadYears" :key="ixx" :value="item.academic_year_id">
                                    {{ item.academic_year_code }} - {{ item.academic_year_desc }}
                                </option>
                            </b-select>
                        </b-field>
                        <div class="has-text-bold">
                            Name: 
                            <span>{{ this.user.lname }}, {{ this.user.fname }} {{ this.user.mname }}</span>
                        </div>
                        <div class="has-text-bold">
                            Sex: 
                            <span>{{ this.user.sex }}</span>
                        </div> 

                        <div class="table-faculty-load">
                            <div class="faculty-body">
                                <div class="buttons mt-4">
                                    <modal-browse-schedules
                                        :prop-acad-year-id="acadYear"
                                        @browseSchedule="emitBrowseSchedule"></modal-browse-schedules>
                                </div>
                                <table class="table-courses">
                                    <tr>
                                        <th>ID</th>
                                        <th>Code</th>
                                        <th>Description</th>
                                        <th>Type/Unit</th>
                                        <th>Schedule</th>
                                        <th>Day</th>
                                    </tr>

                                    <tr v-for="(item, ix) in facultyLoads" :key="ix">
                                        <td>{{ item.schedule_id }}</td>
                                        <td>{{ item.course_code }}</td>
                                        <td>{{ item.course_desc }}</td>
                                        <td>{{ item.course_type }} ({{ item.course_unit }})</td>
                                        <td>{{ item.start_time | formatTime }} - {{ item.end_time | formatTime }}</td>
                                        <td>
                                            <span v-if="item.mon">M</span>
                                            <span v-if="item.tue">T</span>
                                            <span v-if="item.wed">W</span>
                                            <span v-if="item.thu">TH</span>
                                            <span v-if="item.fri">F</span>
                                            <span v-if="item.sat">SAT</span>
                                            <span v-if="item.sun">SUN</span>
                                        </td>
                                    </tr>
                                </table>

                            </div>

                           
                        </div>
                        
                    </div>
                </div><!--col -->
            </div><!-- cols -->
        </div><!--section div-->


    </div>
</template>

<script>

export default{

    props: ['propUser', 'propAcadYears'],
    data() {

        return{
            user: {},
            acadYears: [],
            acadYear: null,


            facultyLoads: [],
        }

    },

    methods: {
       
        initData(){
            this.user = JSON.parse(this.propUser)
            this.acadYears = JSON.parse(this.propAcadYears)
        },


        addRow(){
            this.facultyLoads.push({

            });
        },
        removeRow(ix){
            this.facultyLoads.splice(ix, 1);
        },

        emitBrowseSchedule(row){
            
            // avoid double select from schedule list
            let flag = false;
            let id = row.schedule_id;
            this.facultyLoads.forEach(el=>{
                if(id === el.schedule_id){
                    flag = true;
                }
            });
            //avoid double select from schedule list

            if(!flag){
                this.facultyLoads.push({
                    academic_year_id: this.acadYear,
                    schedule_id: row.schedule_id,
                    course_id: row.course_id,
                    course_code: row.course.course_code,
                    course_desc: row.course.course_desc,
                    course_type: row.course.course_type,
                    course_unit: row.course.course_unit,
                    start_time: row.start_time,
                    end_time: row.end_time,
                    mon: row.mon,
                    tue: row.tue,
                    wed: row.wed,
                    thu: row.thu,
                    fri: row.fri,
                    sat: row.sat,
                    sun: row.sun
                })
            }
        }
    },

    mounted() {
        this.initData()
       
    }
}
</script>


<style>

    .table-faculty-load{
        margin: 10px 0;
        border: 1px solid #e2e2e2;
    }
    .faculty-body{
        padding: 5px;
    }
    .table-courses{
        margin: 10px;
    }
    .table-courses tr th, .table-courses tr td{
        padding: 5px 10px;
    }

</style>
