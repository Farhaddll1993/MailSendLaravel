<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">UserList</div>

          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Created At</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(user, index) in userList" :key="index">
                  <td>{{ user.name }}</td>
                  <td>{{ user.email }}</td>
                  <td>
                    <button id="{{user.id}}" :disabled="disabledbutton[index]"  class="btn btn-danger d-flex justify-content-center align-items-center" @click="mailSend(user.email , index)">
                      <i :hidden="disabledbutton[index]" class="fas fa-comment"></i>
                      <i  :hidden="!disabledbutton[index]" class="spinner-grow spinner-grow-sm text-primary" role="status">
                          
                      </i>
                    </button>
                    
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  props: ["user"],
  mounted() {
    this.getUserList();
  },
  data() {
    return {
      userList: null,
      disabledbutton:[],
    };
  },
  methods: {
    getUserList() {
      axios
        .get("getUserList")
        .then((result) => {
          this.userList = result.data;
          
          for (let index = 0; index < this.userList.length; index++) {
            this.disabledbutton.push(false);     
            console.log(true);       
          }
        })
        .catch((err) => {
          console.log(err);
        });
    },
    mailSend(userEmail , index) {
      this.disabledbutton[index] = true;
      let datatoSend = {
        userEmail: userEmail,
        index:index,
      };
      axios
        .post("/sendEmail", datatoSend)
        .then((result) => {
          // console.log(result.data);
          this.disabledbutton[result.data.index] = false;
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>
