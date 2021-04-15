import colors from 'vuetify/es5/util/colors'

export default {
    buildModules: ['@nuxtjs/vuetify', '@nuxtjs/google-fonts'],

    googleFonts: {
        families: {
            // Kanit: true,
            Prompt: true,

            Kanit: {
                wght: [300],
                // ital: [100],
            },
            Prompt: {
                wght: [300],
                // ital: [100],
            },
        },
    },
    /*
     ** Nuxt rendering mode
     ** See https://nuxtjs.org/api/configuration-mode
     */
    mode: 'spa',
    /*
     ** Nuxt target
     ** See https://nuxtjs.org/api/configuration-target
     */
    target: 'static',
    /*
     ** Headers of the page
     ** See https://nuxtjs.org/api/configuration-head
     */
    head: {
        titleTemplate: '%s - ' + process.env.npm_package_name,
        title: process.env.npm_package_name ||
            'ระบบบันทึกข้อมูลผู้สัมผัสเสี่ยงในสถานพยาบาล : กรณีพบผู้ติดเชื้อในสถานพยาบาล',
        meta: [
            { charset: 'utf-8' },
            { name: 'viewport', content: 'width=device-width, initial-scale=1' },
            {
                hid: 'description',
                name: 'description',
                content: process.env.npm_package_description || '',
            },
        ],
        link: [{ rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }],
        // link: [
        //     { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' },
        //     {
        //         rel: 'stylesheet',
        //         href: 'https://fonts.googleapis.com/css2?family=Kanit:wght@300&family=Prompt:wght@300;400&display=swap',
        //     },
        // ],
    },
    /*
     ** Global CSS
     */
    css: [],
    /*
     ** Plugins to load before mounting the App
     ** https://nuxtjs.org/guide/plugins
     */
    plugins: [{ src: '~/plugins/vue-good-table', ssr: false }],
    /*
     ** Auto import components
     ** See https://nuxtjs.org/api/configuration-components
     */
    components: true,
    /*
     ** Nuxt.js dev-modules
     */

    /*
     ** Nuxt.js modules
     */
    modules: [
        // Doc: https://axios.nuxtjs.org/usage
        '@nuxtjs/axios',
        'vue-sweetalert2/nuxt',
        // 'nuxt-basic-auth-module',
    ],

    // basic: {
    //     name: 'u10682',
    //     pass: 'p10682',
    // },

    /*
     ** Axios module configuration
     ** See https://axios.nuxtjs.org/options
     */
    axios: {
        //home
        baseURL: 'http://localhost/report-covid/backend/',
        //server 5.1
        // baseURL: 'http://192.168.5.1/dsonline/backend/',
        //takis
        // baseURL: 'http://61.19.25.207/dsonline/backend/',
    },

    /*
     ** vuetify module configuration
     ** https://github.com/nuxt-community/vuetify-module
     */
    vuetify: {
        customVariables: ['~/assets/variables.scss'],
        theme: {
            dark: false,
            themes: {
                dark: {
                    primary: colors.blue.darken2,
                    accent: colors.grey.darken3,
                    secondary: colors.amber.darken3,
                    info: colors.teal.lighten1,
                    warning: colors.amber.base,
                    error: colors.deepOrange.accent4,
                    success: colors.green.accent3,
                },
            },
        },
    },
    /*
     ** Build configuration
     ** See https://nuxtjs.org/api/configuration-build/
     */
    build: {},
}