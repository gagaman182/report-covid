<template>
  <v-app dark>
    <v-navigation-drawer
      v-model="drawer"
      :mini-variant="miniVariant"
      :clipped="clipped"
      fixed
      app
      color="#4a47a3"
    >
      <v-card class="mx-auto" max-width="344" outlined color="#5b6d5b ">
        <v-list-item three-line>
          <v-list-item-content>
            <v-list-item-title class="headline mb-2 yellow--text">
              Risk Contact
            </v-list-item-title>
          </v-list-item-content>
          <!-- <v-list-item-avatar tile size="50" color="grey"></v-list-item-avatar> -->
          <!-- <v-list-item-avatar>
            <img src="@/assets/covid19main.jpg" />
          </v-list-item-avatar> -->
          <img src="@/assets/65.jpg" class="img-fluid rounded-circle" />
        </v-list-item>
      </v-card>
      <v-list>
        <v-list-item
          v-for="(item, i) in items"
          :key="i"
          :to="item.to"
          router
          exact
        >
          <v-list-item-action>
            <v-icon class="yellow--text" size="25">{{ item.icon }}</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <!-- <h1 class="title">
              <v-list-item-title v-text="item.title" />
            </h1> -->
            <v-list-item-title v-text="item.title" class="white--text" />
            <!-- <h3 class="white--text">
              {{ item.title }}
            </h3> -->
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>
    <v-app-bar :clipped-left="clipped" color="#709fb0" fixed app>
      <!-- <v-app-bar-nav-icon @click.stop="drawer = !drawer" /> -->
      <!-- ปุ่มลูกศร -->
      <v-btn icon @click.stop="miniVariant = !miniVariant">
        <v-icon>mdi-{{ `chevron-${miniVariant ? 'right' : 'left'}` }}</v-icon>
      </v-btn>
      <!-- <v-btn icon @click.stop="clipped = !clipped">
        <v-icon>mdi-application</v-icon>
      </v-btn> -->
      <!-- <v-btn icon @click.stop="fixed = !fixed">
        <v-icon>mdi-minus</v-icon>
      </v-btn> -->
      <v-toolbar-title v-text="title" class="yellow--text" />

      <!-- <h2 class="texthead">
        ระบบบันทึกข้อมูลผู้สัมผัสเสี่ยงในสถานพยาบาล :
        กรณีพบผู้ติดเชื้อในสถานพยาบาล
      </h2> -->
      <v-spacer />
      <!-- <v-btn icon @click.stop="rightDrawer = !rightDrawer">
        <v-icon>mdi-menu</v-icon>
      </v-btn> -->
    </v-app-bar>

    <v-main>
      <v-system-bar dark color="primary">
        <v-spacer></v-spacer>

        <v-icon>mdi-calendar-range </v-icon>{{ datenow }}
        <v-icon>mdi-clock-time-five-outline </v-icon> {{ timenow }}
      </v-system-bar>

      <v-container>
        <nuxt />
      </v-container>
    </v-main>
    <!-- <v-navigation-drawer v-model="rightDrawer" :right="right" temporary fixed>
      <v-list>
        <v-list-item @click.native="right = !right">
          <v-list-item-action>
            <v-icon light> mdi-repeat </v-icon>
          </v-list-item-action>
          <v-list-item-title>Switch drawer (click me)</v-list-item-title>
        </v-list-item>
      </v-list>
    </v-navigation-drawer> -->
    <v-footer :absolute="!fixed" app>
      <span>&copy; {{ new Date().getFullYear() }}</span>
    </v-footer>
  </v-app>
</template>

<script>
export default {
  data() {
    return {
      datenow: new Date().toISOString().substr(0, 10),
      timenow: new Date().toString().substr(16, 5),
      clipped: true,
      drawer: true,
      fixed: true,
      items: [
        {
          icon: 'mdi-account-alert-outline ',
          title: 'รายงานพบผู้ติดเชื้อ',
          to: '/',
        },
        {
          icon: 'mdi-allergy ',
          title: 'สัมผัสผู้ติดเชื้อ',
          to: '/general',
        },
        {
          icon: 'mdi-monitor-dashboard ',
          title: 'เฝ้าระวัง 14 วัน',
          to: '/monitor',
        },
      ],
      miniVariant: false,
      right: true,
      rightDrawer: true,
      title:
        'ระบบบันทึกข้อมูลผู้สัมผัสเสี่ยงในสถานพยาบาล : กรณีพบผู้ติดเชื้อในสถานพยาบาล',
      collapseOnScroll: true,
    }
  },
}
</script>
<style>
body {
  font-family: 'Kanit', sans-serif;
  font-family: 'Prompt', sans-serif;
}
.texthead {
  color: #2d6187;
}
</style>
