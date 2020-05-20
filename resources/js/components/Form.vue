<template>
    <v-app>
            <div>
                <v-stepper v-model="step" alt-labels>
                    <v-stepper-header>
                        <v-stepper-step :complete="step > 1" step="1">Personal Info</v-stepper-step>

                        <v-divider></v-divider>

                        <v-stepper-step :complete="step > 2" step="2">Identify Proof</v-stepper-step>

                        <v-divider></v-divider>

                        <v-stepper-step :complete="step > 3" step="3">Confirmation</v-stepper-step>
                    </v-stepper-header>
                </v-stepper>
            </div>

        <v-container>
            <v-row
                justify="center">
                <v-col
                    md="4"
                    cols="6"
                >
                    <div v-if="step === 1">
                            <div class="overline mb-4">Personal info</div>

                            <v-text-field
                                v-model="text.email"
                                label="E-mail"
                                type="email"
                                :rules="[rules.required, rules.email]"
                            ></v-text-field>
                            <v-text-field
                                v-model="text.zip"
                                :counter="4"
                                label="Zip"
                                :rules="[rules.required]"
                            ></v-text-field>

                            <v-text-field
                                v-model="text.address"
                                label="Address"
                                :rules="[rules.required, rules.counter]"
                            ></v-text-field>

                            <v-btn @click="clear">clear</v-btn>
                            <v-btn id="btn" color="blue lighten-4" class="mr-4" @click="next">Next</v-btn>


            </div>

            <div v-if="step === 2">
                <p>The debt enforcement office needs a valid proof of identity for the request.
                    Photograph or scan the specified pages of your identity document (identity card or passport). Please
                    ensure that your photo, personal details and signature are complete and easily identifiable.</p>

                    <div class="container">
                        <div class="large-12 medium-12 small-12 cell">
                                <v-file-input
                                    label="Passport"
                                    placeholder="Pick your passport"
                                    type="file"
                                    id="image"
                                    ref="image"
                                    prepend-icon="mdi-camera"
                                    v-model="image"
                                />
                                    <!--v-on:change="onChangeFileUpload()" не нужен при работе с vuetify-->

                        </div>
                    </div>
                    <v-btn  type="button" @click.prevent="prev()">Previous</v-btn>
                    <v-btn color="blue lighten-4" type="button" @click.prevent="next()">Next</v-btn>
                </div>

            <div v-if="step === 3">
                <div>
                    <h5>Overview:</h5>
                    <div v-for="(value, name) in text">
                        {{ name }} : {{ value }}
                    </div>
                    <a class="btn btn-link" role="button" @click.prevent="edit()">Edit</a>

                </div>
                    <hr>
                    <h5>Signature:</h5>
                        <signature-component @input="onClickChild"></signature-component>

                <div class="mt-1 ">
                <v-btn class="btn btn-light" type="button" @click.prevent="prev()">Previous</v-btn>
                    <v-btn
                        rounded color="primary"
                        type="submit"
                        @click.prevent="submit()"
                    >
                        Send
                        <v-icon right dark>mdi-cloud-upload</v-icon>
                    </v-btn>
                </div>
            </div>
                    </v-col>
                </v-row>
            </v-container>
    </v-app>
</template>

<script>
    import Signature from "./Signature";
    import Files from "./Files";
    import axios from 'axios';
    export default {
        components: {Signature},
        data: () => {
            return {
                rules: {
                    required: value => !!value || 'Required.',
                    counter: value => value.length <= 25 || 'Max 25 characters',
                    email: value => {
                        const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                        return pattern.test(value) || 'Invalid e-mail.'
                    },
                },
                dialog: false,
                sign: '',
                image: null,
                text: ({
                    email: '',
                    zip: '',
                    address: '',
                }),
                step: 1,
            }
        },

        methods: {
            onClickChild(value) {
                //console.log(value);
                this.sign = value;
                console.log(this.sign);
            },
            edit() {
                this.step = 1;
            },

            prev() {
                this.step--;
            },
            next() {
                this.step++;
            },
            submit() {
                let formData = new FormData();
                formData.append('sign', this.sign);
                formData.append('image', this.image);
                formData.append('email', this.text.email);
                formData.append('zip', this.text.zip);
                formData.append('address', this.text.address);

                for (var pair of formData.entries()) {   // вывод в консоль всей формдаты
                    console.log(pair[0] + ', ' + pair[1]);
                }

                axios.post('http://tax.loc/api/store',
                    formData,
                    {
                        headers: {
                            'content-Type': 'multipart/form-data',
                        }
                    }
                ).then(function () {
                    console.log('Success');
                    window.location.href = 'http://tax.loc/user';
                    alert('Success! Your request is in progress')

                })
                    .catch(function () {
                        console.log('FAILURE!!');
                        window.location.href = 'http://tax.loc/';
                        alert('Incorrect data! Fill it out correctly');

                    });
            },
            clear() {
                this.text.email = '';
                this.text.zip = '';
                this.text.address = '';
            },
            register(){
                this.dialog = false;
                window.location.href = 'http://tax.loc/register';
            },
            login(){
                this.dialog = false;
                window.location.href = 'http://tax.loc/login';
            },
        }
    }
</script>
