<template>
  <v-card class="mx-auto" outlined>
    <v-list-item three-line>
      <v-list-item-content>
        <v-form v-model="valid">
          <v-container>
            <v-row>
              <v-col cols="12" md="4">
                <v-select :items="an" label="สัมผัส AN"></v-select>
              </v-col>

              <v-col cols="12" md="4">
                <v-text-field
                  v-model="idcard"
                  label="เลข 13 หลัก"
                  :counter="13"
                ></v-text-field>
              </v-col>

              <v-col cols="12" md="4">
                <v-text-field
                  v-model="mobile"
                  label="เบอร์โทร"
                  class="headline"
                ></v-text-field>
              </v-col>
            </v-row>
          </v-container>
        </v-form>
      </v-list-item-content>
    </v-list-item>
  </v-card>
</template>
<script>
import axios from 'axios'
export default {
  components: {},
  data: () => ({
    idcard: '',
    mobile: '',
    ancovid: [],
    an: '',
  }),
  mounted() {
    this.fetch_covid()
  },
  methods: {
    async fetch_covid() {
      await axios
        .get(`${this.$axios.defaults.baseURL}covid.php`)
        .then((response) => {
          this.ancovid = response.data
          this.an = this.ancovid.map((item) => item.an)
        })
    },
  },
}
</script>
