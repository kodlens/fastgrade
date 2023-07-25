<template>
    <div>
        <div class="section">
            <div class="columns is-centered">
                <div class="column is-10">
                    <div class="box">

                        
                    </div>
                </div><!--col -->
            </div><!-- cols -->
        </div><!--section div-->


    </div>
</template>

<script>

export default{
    props: ['propUser'],
    data() {

        return{
            user: {},
        }

    },

    methods: {
       
        initData(){
            this.user = JSON.parse(this.propUser)
            console.log(this.user)
        }
    },

    mounted() {
        this.initData()
       
    }
}
</script>


<style>


</style>
