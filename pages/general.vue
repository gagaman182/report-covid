<template>
  <v-layout row align-center>
    <v-flex xs12 md12>
      <v-card class="mx-auto">
        <v-card-title class="subheadline texthead font-weight-bold">
          <v-icon class="subheadline texthead font-weight-bold"
            >mdi-allergy</v-icon
          >&nbsp;สัมผัสผู้ติดเชื้อ
        </v-card-title>

        <v-flex xs12 md12>
          <v-card class="mx-auto">
            <v-alert border="top" colored-border color="#a7c5eb" elevation="2">
              <h3 class="texthead font-weight-bold teal--text">ข้อมูลทั่วไป</h3>
              <v-card class="mx-auto" outlined>
                <v-list-item three-line>
                  <v-list-item-content>
                    <v-form v-model="valid">
                      <v-container>
                        <v-row>
                          <v-col cols="12" md="4">
                            <v-autocomplete
                              v-model="idcard"
                              :items="cid"
                              label="เลข 13 หลัก"
                              :counter="13"
                              color="blue"
                              @change="cid_detail()"
                              filled
                              outlined
                            >
                            </v-autocomplete>
                          </v-col>

                          <v-col cols="12" md="4">
                            <v-text-field
                              v-model="mobile"
                              label="เบอร์โทร"
                              class="headline"
                              filled
                              outlined
                            ></v-text-field>
                          </v-col>
                          <v-col cols="12" md="4">
                            <v-text-field
                              v-model="department"
                              label="หน่วยที่ให้บริการ"
                              class="headline"
                              filled
                              outlined
                            ></v-text-field>
                          </v-col>
                        </v-row>
                        <v-row>
                          <v-col cols="12" md="4">
                            <div class="body-1" v-if="showdetail">
                              <v-alert
                                color="#4a47a3"
                                dark
                                border="left"
                                prominent
                                class="headline"
                              >
                                ชื่อ-สกุล&nbsp;:&nbsp;{{ prename
                                }}{{ name }}&nbsp;{{ lastname }}
                              </v-alert>
                            </div>
                          </v-col>
                          <v-col cols="12" md="4">
                            <div class="body-1" v-if="showdetail">
                              <v-alert
                                color="#4a47a3"
                                dark
                                border="left"
                                prominent
                                class="headline"
                              >
                                วิชาชีพ&nbsp;:&nbsp;{{ work_position[0] }}
                              </v-alert>
                            </div>
                          </v-col>
                        </v-row>
                      </v-container>
                    </v-form>
                  </v-list-item-content>
                </v-list-item>
              </v-card>
            </v-alert>
          </v-card>
        </v-flex>
        <v-flex xs12 md12>
          <v-card class="mx-auto">
            <v-alert border="top" colored-border color="#a7c5eb" elevation="2">
              <h3 class="texthead font-weight-bold teal--text">
                ประวัติเสี่ยง
              </h3>

              <v-card class="mx-auto" outlined>
                <v-list-item three-line>
                  <v-list-item-content>
                    <v-form v-model="valid">
                      <v-container>
                        <v-row>
                          <v-col cols="12" md="4">
                            <v-select
                              v-model="an"
                              :items="an"
                              label="สัมผัส AN"
                              filled
                              outlined
                            ></v-select>
                          </v-col>
                          <v-col cols="12" md="4">
                            <v-menu
                              v-model="fromDateMenu"
                              :close-on-content-click="false"
                              :nudge-right="40"
                              transition="scale-transition"
                              offset-y
                              min-width="auto"
                            >
                              <template v-slot:activator="{ on }">
                                <v-text-field
                                  label="วันที่สัมผัสผู้ติดเชื้อ"
                                  readonly
                                  :value="fromDateDisp"
                                  v-on="on"
                                  v-model="datecontactstring"
                                  filled
                                  outlined
                                ></v-text-field>
                              </template>
                              <v-date-picker
                                v-model="datecontact"
                                no-title
                                @input="fromDateMenu = false"
                                locale="th-TH"
                              ></v-date-picker>
                            </v-menu>
                          </v-col>
                          <v-col cols="12" md="4">
                            <v-text-field
                              v-model="timecontact"
                              type="number"
                              label="ระยะเวลาสัมผัส(นาที)"
                              filled
                              outlined
                            ></v-text-field>
                          </v-col>
                        </v-row>
                        <v-row>
                          <v-col cols="12" md="4" class="headline">
                            สัมผัสผู้ติดเชื้อ
                          </v-col>
                          <v-col cols="12" md="4" class="headline">
                            <v-checkbox
                              v-model="concat_person"
                              label="ใช่"
                              value="yes"
                            ></v-checkbox>
                          </v-col>
                          <v-col cols="12" md="4" class="headline">
                            <v-checkbox
                              v-model="concat_person"
                              label="ไม่ใช่"
                              value="no"
                            ></v-checkbox>
                          </v-col>
                        </v-row>
                        <v-row>
                          <v-col cols="12" md="4" class="headline">
                            สัมผัสสารคัดหลั่งผู้ติดเชื้อ
                          </v-col>
                          <v-col cols="12" md="4" class="headline">
                            <v-checkbox
                              v-model="concat_secretion"
                              label="ใช่"
                              value="yes"
                            ></v-checkbox>
                          </v-col>
                          <v-col cols="12" md="4" class="headline">
                            <v-checkbox
                              v-model="concat_secretion"
                              label="ไม่ใช่"
                              value="no"
                            ></v-checkbox>
                          </v-col>
                        </v-row>
                        <v-row>
                          <v-col cols="12" md="4" class="headline">
                            สัมผัสละอองฝอยจากผู้ป่วย
                          </v-col>
                          <v-col cols="12" md="4" class="headline">
                            <v-checkbox
                              v-model="concat_aerosol"
                              label="ใช่"
                              value="yes"
                            ></v-checkbox>
                          </v-col>
                          <v-col cols="12" md="4" class="headline">
                            <v-checkbox
                              v-model="concat_aerosol"
                              label="ไม่ใช่"
                              value="no"
                            ></v-checkbox>
                          </v-col>
                        </v-row>
                        <v-row>
                          <v-col cols="12" md="4" class="headline">
                            ใส่ชุดป้องกันตามมาตรฐาน
                          </v-col>
                          <v-col cols="12" md="4" class="headline">
                            <div
                              class="title grey--text text--darken-1 text-md-center"
                            >
                              <v-select
                                v-model="clothing"
                                :items="clothing_items"
                                item-text="name"
                                item-value="id"
                                label="ระบุ"
                                multiple
                                outlined
                                filled
                                chips
                                @change="clothing_check()"
                                item-color="#4a47a3"
                              >
                                <template #selection="{ item }">
                                  <v-chip color="#4a47a3" dark>{{
                                    item.name
                                  }}</v-chip>
                                </template>
                              </v-select>
                            </div>
                          </v-col>
                          <v-col cols="12" md="4" class="headline">
                            <v-textarea
                              v-if="clothing_other_show"
                              v-model="clothing_other"
                              filled
                              outlined
                              label="อื่นๆ ระบุ"
                            ></v-textarea>
                          </v-col>
                        </v-row>
                      </v-container>
                    </v-form>
                  </v-list-item-content>
                </v-list-item>
              </v-card>
            </v-alert>
          </v-card>
        </v-flex>
        <v-flex xs12 md12>
          <v-card class="mx-auto">
            <v-alert border="top" colored-border color="#a7c5eb" elevation="2">
              <h3 class="texthead font-weight-bold teal--text">
                อาการและอาการแสดง
              </h3>

              <v-card class="mx-auto" outlined>
                <v-list-item three-line>
                  <v-list-item-content>
                    <v-form v-model="valid">
                      <v-container>
                        <v-row>
                          <v-col cols="12" md="4" class="headline">
                            มีอาการไข้
                          </v-col>
                          <v-col cols="12" md="2" class="headline">
                            <v-checkbox
                              v-model="temp"
                              label="มีไข้"
                              value="yes"
                            ></v-checkbox>
                          </v-col>
                          <v-col cols="12" md="2" class="headline">
                            <v-checkbox
                              v-model="temp"
                              label="ไม่มีไข้"
                              value="no"
                            ></v-checkbox>
                          </v-col>
                          <v-col cols="12" md="4" class="headline">
                            <v-text-field
                              v-model="temp_other"
                              type="number"
                              label="อุณหภูม(°C)"
                              filled
                              outlined
                            ></v-text-field>
                          </v-col>
                        </v-row>
                        <v-row>
                          <v-col cols="12" md="4" class="headline">
                            อาการแสดง
                          </v-col>
                          <v-col cols="12" md="4" class="headline">
                            <div
                              class="title grey--text text--darken-1 text-md-center"
                            >
                              <v-select
                                v-model="symptom"
                                :items="symptom_items"
                                item-text="name"
                                item-value="id"
                                label="ระบุ"
                                multiple
                                outlined
                                chips
                                filled
                                @change="symptom_check()"
                                item-color="#4a47a3"
                              >
                                <template #selection="{ item }">
                                  <v-chip color="#4a47a3" dark>{{
                                    item.name
                                  }}</v-chip>
                                </template>
                              </v-select>
                            </div>
                          </v-col>
                          <v-col cols="12" md="4" class="headline">
                            <v-textarea
                              v-if="symptom_other_show"
                              v-model="symptom_other"
                              filled
                              outlined
                              label="อื่นๆ ระบุ"
                            ></v-textarea>
                          </v-col>
                        </v-row>
                      </v-container>
                    </v-form>
                  </v-list-item-content>
                </v-list-item>
              </v-card>
            </v-alert>
            <v-row class="mx-auto">
              <v-card-actions class="pt-0">
                <v-col class="headline" align="end">
                  <div class="my-2">
                    <v-btn
                      v-if="btnshow"
                      color="primary"
                      dark
                      large
                      @click="btnadd()"
                    >
                      บันทึก
                    </v-btn>
                  </div> </v-col
                ><v-col class="headline">
                  <div class="my-2">
                    <v-btn
                      v-if="btnshow"
                      color="error"
                      dark
                      large
                      @click="btnremove()"
                    >
                      ยกเลิก
                    </v-btn>
                  </div>
                </v-col>
              </v-card-actions></v-row
            >
          </v-card>
        </v-flex>
      </v-card>
    </v-flex>
  </v-layout>
</template>

<script>
// ทำ date format dd/mm/yyyy datepicker
function gettanggal(str) {
  if (str != null) {
    return (
      str.substring(8, 10) +
      '/' +
      str.substring(5, 7) +
      '/' +
      str.substring(0, 4)
    )
  }
  return ''
}
import axios from 'axios'
export default {
  components: {},
  data: () => ({
    idcard: '',
    idcardall: '',
    cid: '',
    contact_detail: '',
    work_position: '',
    department: '',
    prename: '',
    name: '',
    lastname: '',
    mobile: '',
    ancovid: [],
    an: '',
    concat_person: 'no',
    concat_secretion: 'no',
    concat_aerosol: 'no',
    datecontact: '',
    datecontactstring: '',
    timecontact: '',
    fromDateMenu: false,
    showdetail: false,
    clothing_items: [],
    clothing: [],
    clothing_other: '',
    clothing_other_show: false,
    temp: 'no',
    temp_other: '',
    temp_other_show: false,
    symptom_items: [],
    symptom: [],
    symptom_other: '',
    symptom_other_show: false,
    btnshow: false,
  }),
  mounted() {
    this.fetch_covid()
    this.fetch_idcard()
    this.fecth_clothing()
    this.fecth_symptom()
  },
  methods: {
    // หา an
    async fetch_covid() {
      await axios
        .get(`${this.$axios.defaults.baseURL}covid.php`)
        .then((response) => {
          this.ancovid = response.data
          this.an = this.ancovid.map((item) => item.an)
        })
    },
    //หา 13 หลัก
    async fetch_idcard() {
      await axios
        .get(`${this.$axios.defaults.baseURL}cid.php`)
        .then((response) => {
          this.idcardall = response.data
          this.cid = this.idcardall.map((item) => item.cid)
        })
    },
    //ชุดป้องกัน
    async fecth_clothing() {
      await axios
        .get(`${this.$axios.defaults.baseURL}clothing.php`)
        .then((response) => {
          this.clothing_items = response.data
        })
    },
    //อาการ
    async fecth_symptom() {
      await axios
        .get(`${this.$axios.defaults.baseURL}symptom.php`)
        .then((response) => {
          this.symptom_items = response.data
        })
    },
    async cid_detail() {
      await axios
        .post(`${this.$axios.defaults.baseURL}cid_detail.php`, {
          idcard: this.idcard,
        })
        .then((response) => {
          this.contact_detail = response.data
          this.work_position = this.contact_detail.map(
            (item) => item.work_position
          )
          this.prename = this.contact_detail[0].prename
          this.name = this.contact_detail[0].name
          this.lastname = this.contact_detail[0].lastname
          this.department = this.contact_detail[0].in_department
          this.showdetail = true
          this.btnshow = true
        })
    },
    // เลือกอื่นๆ โชว์ textbox
    clothing_check() {
      if (this.clothing.find((element) => element == '6')) {
        this.clothing_other_show = true
      } else if (this.clothing.find((element) => element !== '6')) {
        this.clothing_other_show = false
        this.clothing_other = ''
      } else if (this.clothing.length <= 0) {
        this.clothing_other_show = false
        this.clothing_other = ''
      }
    },

    symptom_check() {
      if (this.symptom.find((element) => element == '10')) {
        this.symptom_other_show = true
      } else if (this.symptom.find((element) => element !== '10')) {
        this.symptom_other_show = false
        this.symptom_other = ''
      } else if (this.symptom.length <= 0) {
        this.symptom_other_show = false
        this.symptom_other = ''
      }
    },
    //ยกเลิก
    btnremove() {
      this.btnshow = false
      this.showdetail = false
      this.idcard = ''
      this.mobile = ''
      this.department = ''
      this.work_position = ''
      this.department = ''
      this.prename = ''
      this.name = ''
      this.lastname = ''
      this.an = ''
      this.datecontact = null
      this.datecontactstring = null
      this.timecontact = ''
      this.concat_person = 'no'
      this.concat_secretion = 'no'
      this.concat_aerosol = 'no'
      this.temp = ''
      this.temp_other = ''
      this.clothing = ''
      this.clothing_other = ''
      this.symptom = ''
      this.symptom_other = ''
    },

    //บันทึก
    btnadd() {
      if (
        !this.idcard ||
        !this.mobile ||
        !this.department ||
        !this.an ||
        !this.datecontact ||
        !this.timecontact
      ) {
        this.$swal({
          title: 'แจ้งเตือน',
          text: 'ระบุข้อมูลไม่ครบ',
          icon: 'error',
          confirmButtonText: 'ตกลง',
        })
      } else {
        this.contact_add()
        this.clothing_add()
        this.contact_symptom_add()
        this.btnremove()
      }
    },
    //add day and datecontact
    async contact_add() {
      await axios
        .post(`${this.$axios.defaults.baseURL}contact_add.php`, {
          idcard: this.idcard,
          mobile: this.mobile,
          department: this.department,
          prename: this.prename,
          name: this.name,
          lastname: this.lastname,
          an: this.an,
          datecontact: this.datecontact,
          timecontact: this.timecontact,
          concat_person: this.concat_person,
          concat_secretion: this.concat_secretion,
          concat_aerosol: this.concat_aerosol,
          temp: this.temp,
          temp_other: this.temp_other,
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

            // this.$refs.child.refresh_drugstore()
          } else {
            this.$swal({
              title: 'สถานะการเพิ่ม',
              text: this.message[0].message,
              icon: 'error',
              confirmButtonText: 'ตกลง',
            })
          }
        })
    },
    //add ชุด clothing
    clothing_add() {
      for (this.s in this.symptom) {
        axios
          .post(`${this.$axios.defaults.baseURL}clothing_add.php`, {
            idcard: this.idcard,
            an: this.an,
            clothing: this.clothing[this.s],
            clothing_other: this.clothing_other,
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
    //add อาการ symptom
    contact_symptom_add() {
      for (this.s in this.symptom) {
        axios
          .post(`${this.$axios.defaults.baseURL}contact_symptom_add.php`, {
            idcard: this.idcard,
            an: this.an,
            symptom: this.symptom[this.s],
            symptom_other: this.symptom_other,
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
  },
  computed: {
    fromDateDisp() {
      return this.datecontact
      // format/do something with date
    },
  },
  watch: {
    datecontact: function (val, oldVal) {
      this.datecontactstring = gettanggal(val)
    },
  },
}
</script>
<style scoped>
.texthead {
  color: #2d6187;
}
.v-input {
  font-size: 1.2em;
  font-weight: 100;
}
</style>
