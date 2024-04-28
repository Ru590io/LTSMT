<template>
    <div>
      <form @submit.prevent="submitForm">
        <div>
          <label for="email">Email:</label>
          <input type="email" id="email" v-model="form.email" @blur="$v.form.email.$touch()">
          <span v-if="$v.form.email.$error">Please enter a valid email.</span>
        </div>
        <div>
          <label for="password">Password:</label>
          <input type="password" id="password" v-model="form.password" @blur="$v.form.password.$touch()">
          <span v-if="$v.form.password.$error">Password must be at least 6 characters.</span>
        </div>
        <button type="submit" :disabled="$v.$invalid">Register</button>
      </form>
    </div>
  </template>

  <script>
  import { required, minLength, email } from 'vuelidate/lib/validators'
  import { validationMixin } from 'vuelidate'

  export default {
    mixins: [validationMixin],
    data() {
      return {
        form: {
          email: '',
          password: ''
        }
      }
    },
    validations: {
      form: {
        email: { required, email },
        password: { required, minLength: minLength(6) }
      }
    },
    methods: {
      submitForm() {
        this.$v.$touch();
        if (!this.$v.$invalid) {
          // Proceed with form submission
          console.log('Form submitted', this.form);
        }
      }
    }
  }
  </script>
