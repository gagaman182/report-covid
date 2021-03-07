<template>
  <v-layout row align-center>
    <v-flex xs12 md12>
      <v-card class="mx-auto">
        <v-card-title class="subheadline texthead font-weight-bold">
          <v-icon class="subheadline texthead font-weight-bold"
            >mdi-account-check </v-icon
          >&nbsp;เพิ่มผู้ติดเชื้อ
        </v-card-title>
        <v-row>
          <v-col cols="12" align="end">
            <v-btn
              large
              v-if="btnmain"
              class="red--text text--lighten-5"
              color="#7579e7"
              flat
              @click="showadd"
            >
              <v-icon medium>mdi-file-plus-outline </v-icon>เพิ่ม</v-btn
            >
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12" align="end">
            <v-toolbar card>
              <v-text-field
                v-model="search"
                flat
                solo
                prepend-icon="mdi-home-search-outline "
                placeholder="ค้นหา"
                hide-details
                class="hidden-sm-and-down"
              ></v-text-field>
            </v-toolbar>
          </v-col>
        </v-row>
        <v-divider></v-divider>
        <v-row>
          <v-col cols="12">
            <v-data-table
              height="40vh"
              v-model="complex.selected"
              :headers="complex.headers"
              :search="search"
              :items="complex.items"
              class="elevation-1 display-2"
              @click:row="handleClick"
            >
              <template v-slot:body="{ items }">
                <tbody>
                  <tr v-for="row in items">
                    <td v-for="col in row">
                      {{ col }}
                    </td>
                  </tr>
                </tbody>
              </template>
            </v-data-table>
          </v-col>

          <v-col cols="12" sm="6">
            <v-text-field
              v-model="id"
              label="ไอดี"
              outlined
              v-if="textboxshow"
            ></v-text-field>
          </v-col>

          <v-col cols="12" sm="6">
            <v-text-field
              v-model="name"
              label="ระดับการศีกษา"
              outlined
              v-if="textboxshow"
            ></v-text-field>
          </v-col>

          <v-col cols="12" align="end">
            <v-btn
              large
              v-if="btnadd"
              class="red--text text--lighten-5"
              color="teal lighten-1"
              flat
              @click="adddata()"
            >
              <v-icon medium>mdi-content-save </v-icon>บันทึก</v-btn
            >
            <v-btn
              large
              v-if="btneditandremove"
              color="#0e49b5"
              @click="updatedata()"
              dark
            >
              <v-icon medium>mdi-content-save-edit </v-icon>
              <h4>แก้ไข</h4></v-btn
            >
            <v-btn
              large
              v-if="btneditandremove"
              color="#c56183"
              @click="removedata()"
              dark
            >
              <v-icon medium>mdi-delete-forever </v-icon>
              <h4>ลบ</h4></v-btn
            >
            <v-btn
              large
              v-if="btncancel"
              color="#b088f9"
              class="red--text text--lighten-5"
              flat
              @click="cleartext"
            >
              <v-icon medium>mdi-autorenew </v-icon>ยกเลิก</v-btn
            >
          </v-col>
        </v-row>
      </v-card>
    </v-flex>
  </v-layout>
</template>

<script>
import axios from 'axios'
export default {
  data: () => ({
    search: '',
    complex: {
      selected: [],
      headers: [
        {
          text: 'ลำดับที่',
          value: 'num',
        },
        {
          text: 'วันที่',
          value: 'date',
        },
        {
          text: 'AN',
          value: 'an',
        },
        {
          text: 'หอผู้ป่วย',
          value: 'ward',
        },
      ],
      items: [],
    },
    num: '',
    id: '',
    name: '',
    textboxshow: '',
    btneditandremove: false,
    btnmain: true,
    btnadd: false,
    btncancel: false,
  }),
  mounted() {
    this.fetch_covid()
  },
  methods: {
    //แสดงข้อมูลร้านค้า
    async fetch_covid() {
      await axios
        .get(`${this.$axios.defaults.baseURL}covid.php`)
        .then((response) => {
          this.complex.items = response.data
        })
    },
    // click table
    handleClick(value) {
      // this.dialog = true
      // this.$emit('show-dialog', { dialog: this.dialog, storeid: value.storeid })
      this.num = value.num
      this.id = value.education
      this.name = value.name
      this.btneditandremove = true
      this.textboxshow = true
      this.btncancel = true
      this.btnadd = false
    },
    //show textbox and btn
    showadd() {
      this.btnadd = true
      this.btncancel = true
      this.textboxshow = true
      this.btnmain = false
    },
    //เพิ่มข้อมูล
    adddata() {
      let type = 'education'

      if (!this.id || !this.name) {
        this.$swal({
          title: 'แจ้งเตือน',
          text: 'ระบุข้อมูลไม่ครบ',
          icon: 'error',
          confirmButtonText: 'ตกลง',
        })
      } else {
        axios
          .post(`${this.$axios.defaults.baseURL}t_add.php`, {
            num: this.num,
            id: this.id,
            name: this.name,
            type: type,
          })
          .then((response) => {
            this.message = response.data
            if (this.message[0].message === 'เพิ่มข้อมูลสำเร็จ') {
              this.$swal({
                title: 'สถานะการเพิ่ม',
                text: this.message[0].message,
                icon: 'success',
                confirmButtonText: 'ตกลง',
              })
              this.fetch_covid()
              this.cleartext()
            } else {
              this.$swal({
                title: 'สถานะการเพิ่ม',
                text: this.message[0].message,
                icon: 'error',
                confirmButtonText: 'ตกลง',
              })
            }
          })
      }
    },

    //ลบ ข่อมูล
    removedata() {
      let type = 'education'
      if (!this.id) {
        this.$swal({
          title: 'แจ้งเตือน',
          text: 'ไม่พบข้อมูล',
          icon: 'error',
          confirmButtonText: 'ตกลง',
        })
      } else {
        this.$swal({
          title: 'คุณแน่ใจว่าต้องการลบข้อมูลนี้?',
          text: 'ไอดี: ' + this.id,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#51adcf',
          cancelButtonColor: '#686d76',
          confirmButtonText: 'ลบ',
          cancelButtonText: 'ยกเลิก',
        }).then((result) => {
          if (result.isConfirmed) {
            axios
              .put(`${this.$axios.defaults.baseURL}t_delete.php`, {
                num: this.num,
                id: this.id,
                type: type,
              })
              .then((response) => {
                this.message = response.data

                if (this.message[0].message === 'ลบข้อมูลสำเร็จ') {
                  this.$swal({
                    title: 'สถานะการลบ',
                    text: this.message[0].message,
                    icon: 'success',
                    confirmButtonText: 'ตกลง',
                  })
                  this.fetch_covid()
                  this.cleartext()
                } else {
                  this.$swal({
                    title: 'สถานะการลบ',
                    text: this.message[0].message,
                    icon: 'error',
                    confirmButtonText: 'ตกลง',
                  })
                }
              })
          }
        })
      }
    },
    //แก้ไข ข้อมูล
    updatedata: function () {
      let type = 'education'
      if (!this.id) {
        this.$swal({
          title: 'แจ้งเตือน',
          text: 'ไม่พบข้อมูล',
          icon: 'error',
          confirmButtonText: 'ตกลง',
        })
      } else {
        axios
          .put(`${this.$axios.defaults.baseURL}t_update.php`, {
            num: this.num,
            id: this.id,
            name: this.name,
            type: type,
          })
          .then((response) => {
            this.message = response.data
            if (this.message[0].message === 'แก้ไขข้อมูลสำเร็จ') {
              this.$swal({
                title: 'สถานะการแก้ไข',
                text: this.message[0].message,
                icon: 'success',
                confirmButtonText: 'ตกลง',
              })
              this.fetch_covid()
              this.cleartext()
            } else {
              this.$swal({
                title: 'สถานะการแก้ไข',
                text: this.message[0].message,
                icon: 'error',
                confirmButtonText: 'ตกลง',
              })
            }
          })
      }
    },
    cleartext() {
      this.btnadd = false
      this.btncancel = false
      this.textboxshow = false
      this.btnmain = true
      this.btneditandremove = false
      this.id = ''
      this.name = ''
    },
  },
}
</script>
<style scoped>
.texthead {
  color: #2d6187;
}
.v-data-table > .v-data-table__wrapper > table > tbody > tr > td {
  font-weight: bold;
  font-size: 20px;
}
</style>
