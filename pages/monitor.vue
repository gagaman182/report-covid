<template>
  <v-layout row align-center>
    <v-flex xs12 md12>
      <v-card class="mx-auto">
        <v-card-title class="subheadline texthead font-weight-bold">
          <v-icon class="subheadline texthead font-weight-bold"
            >mdi-monitor-dashboard </v-icon
          >&nbsp;เฝ้าระวังจนครบ 14 วัน
        </v-card-title>
        <v-flex xs12 md12>
          <v-card class="mx-auto">
            <v-alert border="top" colored-border color="#a7c5eb" elevation="2">
              <h3 class="texthead font-weight-bold teal--text">
                วันที่สัมผัสผู้ติดเชื้อถือเป็นวันที่ศูนย์ (day 0)
              </h3>
              <v-card class="mx-auto" outlined>
                <v-list-item three-line>
                  <v-list-item-content>
                    <v-form v-model="valid">
                      <v-container>
                        <v-row>
                          <v-col cols="12" md="4">
                            <h3 class="texthead font-weight-bold teal--text">
                              เลข 13 หลัก
                            </h3></v-col
                          >
                          <v-col cols="12" md="4">
                            <h3 class="texthead font-weight-bold teal--text">
                              วัน
                            </h3></v-col
                          >
                          <v-col cols="12" md="4">
                            <h3 class="texthead font-weight-bold teal--text">
                              วันที่
                            </h3></v-col
                          >
                        </v-row>

                        <v-row>
                          <v-col cols="12" md="4">
                            <v-autocomplete
                              v-model="idcard"
                              :items="cid"
                              label="เลข 13 หลัก"
                              :counter="13"
                              color="blue"
                              filled
                              outlined
                              @input="cid_detail()"
                              :hint="fullname"
                            >
                            </v-autocomplete>
                          </v-col>
                          <v-col cols="12" md="4" class="headline">
                            <v-select
                              :items="days"
                              v-model="day"
                              label="day"
                              outlined
                              filled
                              @change="dayselect()"
                            ></v-select>
                          </v-col>
                          <v-col cols="12" md="4" class="headline">
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
                                  label="วันที่"
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
                        </v-row>
                        <v-row
                          ><v-col cols="12" md="4">
                            <h3 class="texthead font-weight-bold teal--text">
                              อาการและอาการแสดง
                            </h3></v-col
                          >
                          <v-col cols="12" md="4">
                            <h3
                              class="texthead font-weight-bold teal--text"
                              v-if="symptom_check"
                            >
                              ระบุอาการ
                            </h3></v-col
                          >
                          <v-col cols="12" md="4"
                            ><h3
                              class="texthead font-weight-bold teal--text"
                              v-if="symptom_other_show"
                            >
                              อื่นๆ
                            </h3>
                          </v-col></v-row
                        >
                        <v-row>
                          <v-col cols="12" md="2" class="headline">
                            <v-checkbox
                              v-model="sick"
                              label="ไม่มีอาการ"
                              value="no"
                              @change="sick_check()"
                            ></v-checkbox>
                          </v-col>
                          <v-col cols="12" md="2" class="headline">
                            <v-checkbox
                              v-model="sick"
                              label="มีอาการ"
                              value="yes"
                              @change="sick_check()"
                            ></v-checkbox>
                          </v-col>
                          <v-col cols="12" md="4" class="headline">
                            <div
                              class="title grey--text text--darken-1 text-md-center"
                            >
                              <v-select
                                v-if="symptom_check"
                                :disabled="toggleDisable"
                                v-model="symptom"
                                :items="symptom_items"
                                item-text="name"
                                item-value="id"
                                label="ระบุ"
                                multiple
                                outlined
                                filled
                                chips
                                item-color="#4a47a3"
                                @change="symptom_check_other()"
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
                              :disabled="disable_other"
                              v-model="symptom_other"
                              filled
                              outlined
                              label="อื่นๆ ระบุ"
                            ></v-textarea>
                          </v-col>
                        </v-row>

                        <v-row>
                          <v-card-actions class="pt-0">
                            <v-col cols="12" md="6" class="headline">
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
                            ><v-col cols="12" md="6" class="headline">
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
                      </v-container>
                    </v-form>
                  </v-list-item-content>
                </v-list-item>
              </v-card>
              <v-row>
                <v-col cols="12" md="12">
                  <h3 class="texthead font-weight-bold teal--text">
                    ข้อมูลการเฝ้าระวัง 14 วัน
                  </h3>

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
                                  filled
                                  outlined
                                  @change="fecth_quarantine()"
                                  :hint="fullname"
                                >
                                </v-autocomplete>
                              </v-col>
                              <v-col cols="12" md="2">
                                <v-btn
                                  color="#5aa897"
                                  dark
                                  large
                                  @click="showdata"
                                >
                                  แสดงผล
                                </v-btn>
                              </v-col>
                              <v-col cols="12" md="12"
                                ><div>
                                  <vue-good-table
                                    :columns="columns"
                                    :rows="quarantine"
                                    :line-numbers="true"
                                  >
                                    <template
                                      slot="table-row"
                                      slot-scope="props"
                                    >
                                      <span v-if="props.column.field == 'sick'">
                                        <span
                                          v-if="props.row.sick == 'มีอาการ'"
                                          style="font-weight: bold; color: red"
                                          >{{ props.row.sick }}</span
                                        >
                                        <span
                                          v-else
                                          style="
                                            font-weight: bold;
                                            color: green;
                                          "
                                          >{{ props.row.sick }}</span
                                        >
                                      </span>

                                      <span v-else>
                                        {{
                                          props.formattedRow[props.column.field]
                                        }}
                                      </span>
                                    </template></vue-good-table
                                  >
                                </div>
                              </v-col>
                            </v-row>
                          </v-container>
                        </v-form>
                      </v-list-item-content>
                    </v-list-item>
                  </v-card>
                </v-col>
              </v-row>
            </v-alert>
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
    day: '',
    days: [
      '1',
      '2',
      '3',
      '4',
      '5',
      '6',
      '7',
      '8',
      '9',
      '10',
      '11',
      '12',
      '13',
      '14',
    ],
    datecontact: '',
    datecontactstring: '',
    sick: 'no',
    symptom_items: [],
    symptom: [],
    symptom_other: '',
    symptom_check: false,
    symptom_other_show: false,
    toggleDisable: true,
    disable_other: true,
    btnshow: false,
    prename: '',
    name: '',
    lastname: '',
    fullname: '',
    contact_detail: '',
    message: '',
    columns: [
      {
        label: '13หลัก',
        field: 'cid',
        sortable: false,
      },
      {
        label: 'วัน(day)',
        field: 'day',
        sortable: false,
      },
      {
        label: 'วันที่',
        field: 'datecontact',
        type: 'date',
        dateInputFormat: 'yyyy-MM-dd',
        dateOutputFormat: 'dd-MM-yyyy',
        sortable: false,
      },
      {
        label: 'อาการ',
        field: 'sick',
        sortable: false,
      },
      {
        label: 'อาการแสดง',
        field: 'symptom',
        sortable: false,
      },
      {
        label: 'อื่นๆระบุ',
        field: 'symptom_other',
        sortable: false,
      },
    ],

    quarantine: [],
  }),
  mounted() {
    this.fecth_symptom()
    this.fetch_idcard()
    // this.fecth_quarantine()
  },
  methods: {
    //หา 13 หลัก
    async fetch_idcard() {
      await axios
        .get(`${this.$axios.defaults.baseURL}cid.php`)
        .then((response) => {
          this.idcardall = response.data
          this.cid = this.idcardall.map((item) => item.cid)
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
    //แสดงอาการ 14 วัน
    async fecth_quarantine() {
      await axios
        .get(`${this.$axios.defaults.baseURL}quarantine_select.php`, {
          params: {
            idcard: this.idcard,
          },
        })
        .then((response) => {
          this.quarantine = response.data
        })
    },
    symptom_check_other() {
      if (this.symptom.find((element) => element == '10')) {
        this.disable_other = false
        this.symptom_other_show = true
      } else if (this.symptom.find((element) => element !== '10')) {
        this.disable_other = true
        this.symptom_other = ''
        this.symptom_other_show = false
      } else if (this.symptom.length <= 0) {
        this.disable_other = true
        this.symptom_other = ''
        this.symptom_other_show = false
      }
    },
    //เลือกอาการป่วยโชว์ textbox
    sick_check() {
      if (this.sick == 'yes') {
        this.toggleDisable = false
        this.symptom_check = true
      } else if (this.sick == 'no') {
        this.toggleDisable = true
        this.disable_other = true
        this.symptom = ''
        this.symptom_other = ''
        this.symptom_check = false
        this.symptom_other_show = false
      } else if (this.sick === null) {
        this.toggleDisable = true
        this.disable_other = true
        this.symptom = ''
        this.symptom_other = ''
        this.symptom_check = false
        this.symptom_other_show = false
      }
    },
    // แสดงปุ่ม
    dayselect() {
      this.btnshow = true
    },
    // แสดงชื่อจาก 13 หลัก
    async cid_detail() {
      this.btnshow = true
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
          this.fullname = this.prename + this.name + ' ' + this.lastname

          this.fecth_quarantine()
        })
    },
    //ยกเลิก
    btnremove() {
      this.symptom = ''
      this.symptom_other = ''
      this.datecontact = null
      this.datecontactstring = null
      this.quarantine = []

      this.sick = 'no'
      this.day = ''
      this.btnshow = false
      this.symptom_check = false
      this.symptom_other_show = false
      this.idcard = ''
    },
    //บันทึก
    btnadd() {
      if (!this.idcard || !this.day || !this.datecontact || !this.sick) {
        this.$swal({
          title: 'แจ้งเตือน',
          text: 'ระบุข้อมูลไม่ครบ',
          icon: 'error',
          confirmButtonText: 'ตกลง',
        })
      } else {
        //add day and datecontact
        axios
          .post(`${this.$axios.defaults.baseURL}quarantine_add.php`, {
            idcard: this.idcard,
            day: this.day,
            datecontact: this.datecontact,
            sick: this.sick,
          })
          .then((response) => {
            this.message = response.data
            if (this.message[0].message === 'เพิ่มข้อมูลสำเร็จ') {
              this.$swal({
                title: 'เพิ่มข้อมูลสำเร็จ',
                text: this.message[0].message,
                icon: 'success',
                confirmButtonText: 'ตกลง',
              })

              // this.$refs.child.refresh_drugstore()
            } else {
              this.$swal({
                title: 'ไม่สามารถเพิ่มข้อมูลได้',
                text: this.message[0].message,
                icon: 'error',
                confirmButtonText: 'ตกลง',
              })
            }
          })

        //add อาการ
        for (this.s in this.symptom) {
          axios
            .post(`${this.$axios.defaults.baseURL}quarantine_symptom_add.php`, {
              idcard: this.idcard,
              day: this.day,
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
                this.btnremove()
                this.fecth_quarantine()
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
      }
    },
    showdata() {
      this.fecth_quarantine()
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
</style>
