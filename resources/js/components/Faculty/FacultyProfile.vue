<template>
    <div>
        <div>
            <p class="has-text-weight-bold mb-4 has-text-centered title is-5">FACULTY PROFILE</p>
        </div>
        <div class="columns">
            <div class="column">
                <b-field label="Last Name">
                    <b-input
                        type="text"
                        v-model="faculty.lname"
                        placeholder="Last Name"></b-input>
                </b-field>
            </div>
            <div class="column">
                <b-field label="First Name">
                    <b-input
                        type="text"
                        v-model="faculty.fname"
                        placeholder="First Name"></b-input>
                </b-field>
            </div>
        </div>

        <div class="columns">
            <div class="column">
                <b-field label="Middle Name">
                    <b-input
                        type="text"
                        v-model="faculty.mname"
                        placeholder="Middle Name"></b-input>
                </b-field>
            </div>
            <div class="column">
                <b-field label="Suffix">
                    <b-input
                        type="text"
                        v-model="faculty.suffix"
                        placeholder="Suffix"></b-input>
                </b-field>
            </div>
            <div class="column">
                <b-field label="Sex" expanded>
                    <b-select expanded
                        v-model="faculty.sex"
                        placeholder="Sex">
                        <option value="MALE">MALE</option>
                        <option value="FEMALE">FEMALE</option>
                    </b-select>
                </b-field>
            </div>
        </div>


        <div class="columns">
            <div class="column">
                <b-field label="Civil Status" expanded>
                    <b-select expanded
                        v-model="faculty.civil_status"
                        placeholder="Civil Status">
                        <option value="SINGLE">SINGLE</option>
                        <option value="MARRIED">MARRIED</option>
                        <option value="WIDOWED">WIDOWED</option>
                        <option value="SEPARATED">SEPARATED</option>
                    </b-select>
                </b-field>
            </div>

            <div class="column">
                <b-field label="Office">
                    <b-select expanded
                        v-model="faculty.office_id"
                        placeholder="Office">
                        <option v-for="(item, ix) in offices" :key="ix" 
                            :value="item.office_id">{{ item.office }}</option>
                    </b-select>
                </b-field>
            </div>
            <div class="column">
                <b-field label="Contact No.">
                    <b-input
                        type="text"
                        v-model="faculty.contact_no"
                        placeholder="Contact No."></b-input>
                </b-field>
            </div>
        </div>

        <!--address-->
        <hr>
        <div class="columns">
            <div class="column">
                <b-field label="Province" label-position="on-border" expanded
                            :type="this.errors.province ? 'is-danger':''"
                            :message="this.errors.province ? this.errors.province[0] : ''">
                    <b-select v-model="faculty.province.provCode" @input="loadCity" expanded>
                        <option v-for="(item, index) in provinces" :key="index" :value="item.provCode">{{ item.provDesc }}</option>
                    </b-select>
                </b-field>
            </div>

            <div class="column">
                <b-field label="City" label-position="on-border" expanded
                            :type="this.errors.city ? 'is-danger':''"
                            :message="this.errors.city ? this.errors.city[0] : ''">
                    <b-select v-model="faculty.city.citymunCode" @input="loadBarangay" expanded>
                        <option v-for="(item, index) in cities" :key="index" :value="item.citymunCode">{{ item.citymunDesc }}</option>
                    </b-select>
                </b-field>
            </div>
        </div>

        <div class="columns">
            <div class="column">
                <b-field label="Barangay" label-position="on-border" expanded
                            :type="this.errors.barangay ? 'is-danger':''"
                            :message="this.errors.barangay ? this.errors.barangay[0] : ''">
                    <b-select v-model="faculty.barangay.brgyCode" expanded>
                        <option v-for="(item, index) in barangays" :key="index" :value="item.brgyCode">{{ item.brgyDesc }}</option>
                    </b-select>
                </b-field>
            </div>
            <div class="column">
                <b-field label="Street" label-position="on-border">
                    <b-input v-model="faculty.street"
                                placeholder="Street">
                    </b-input>
                </b-field>
            </div>
        </div>

        <hr>

        <div class="buttons is-right">
            <b-button type="is-success"
                @click="submit"
                class="is-outlined"
                label="Update Information"></b-button>
        </div>

    </div>
</template>


<script>
export default{
    data(){
        return{
            faculty: {},
            errors: {},

            offices: [],
            provinces: [],
            cities: [],
            barangays: [],
        }
    },

    methods: {
        loadAsyncData(){
            //this.faculty = JSON.parse(this.propFaculty)
            axios.get('/faculty-profile-info').then(res=>{
                this.faculty = res.data;
                let tempData = res.data;
                //load city first
                //console.log(this.faculty.res_province)
                axios.get('/load-cities?prov=' + this.faculty.province.provCode).then(res=>{
                    //load barangay
                    this.cities = res.data;
                    axios.get('/load-barangays?prov=' + this.faculty.province.provCode + '&city_code='+this.faculty.city.citymunCode).then(res=>{
                        this.barangays = res.data;
                        this.faculty = tempData

                    });
                });
            });
        },

        loadOffices(){
            axios.get('/load-offices').then(res=>{
                this.offices = res.data
            }).catch(err=>{
            
            })
        },

        loadProvince: function(){
            axios.get('/load-provinces').then(res=>{
                this.provinces = res.data;
            })
        },

        loadCity: function(){
            axios.get('/load-cities?prov=' + this.faculty.province.provCode).then(res=>{
                this.cities = res.data;
            })
        },

        loadBarangay: function(){
            axios.get('/load-barangays?prov=' + this.faculty.province.provCode + '&city_code='+this.faculty.city.citymunCode).then(res=>{
                this.barangays = res.data;
            })
        },

   


        submit(){
            axios.put('/faculty-profile/' + this.faculty.user_id, this.faculty).then(res=>{
                if(res.data.status === 'updated'){
                    this.$buefy.dialog.alert({
                        title: 'Updated.',
                        message: 'Information successfully updated.',
                        onConfirm: ()=> {
                            this.loadAsyncData();
                        }
                    })
                }
            }).catch(err=>{
            
            })
        }
    },

    mounted(){
        this.loadProvince()
        this.loadOffices()
        this.loadAsyncData()
    }
}

</script>