<template>
    <div class="container">
        <div class="large-12 medium-12 small-12 cell">
            <label>Files
                <input type="file"  id="files" ref="files" multiple v-on:change="handleFilesUpload"/>
            </label>
        </div>
    </div>
</template>

<script>
    export default {
        /*
          Defines the data used by the component
        */
        data(){
            return {
                files: ''

            }
        },

        methods: {
            /*
              Submits all of the files to the server
            */
            submitFiles(){
                /*
                  Initialize the form data
                */
                let formData = new FormData();

                /*
                  Iteate over any file sent over appending the files
                  to the form data.
                */
                for( var i = 0; i < this.files.length; i++ ){
                    let file = this.files[i];

                    formData.append('files[' + i + ']', file);
                }

                /*
                  Make the request to the POST /multiple-files URL
                */
                axios.post( 'api/images/create',
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                ).then(function(){
                    console.log('SUCCESS!!');
                })
                    .catch(function(){
                        console.log('FAILURE!!');
                    });
            },

            /*
              Handles a change on the file upload
            */
            handleFilesUpload(){
                $this.files = this.$refs.files.files;
            }
        }
    }
</script>
