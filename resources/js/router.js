import VueRouter from 'vue-router'

// Pages

import Login from './Login'
import Main from './App.vue';

import Dashboard from './containers/Main/MainComponent.vue';
import Request from './containers/RequestPage/RequestPageComponent.vue';
import Projects from './containers/allProjectsPage.vue';
import Contracts from './containers/allContractsPage.vue';
// import Reviews from './containers/reviewsPage.vue';
import Appointments from './containers/appointmentsPage.vue';
import Purchase from './containers/purchasePage.vue';
import Sale from './containers/salesPage.vue';
import SearchJobs from './containers/searchJobs.vue';
import JobOffer from './containers/jobOffer.vue';
import Discount from './containers/discount.vue';
import UpfrontRequest from './containers/upfrontRequest.vue';
import RefundRequest from './containers/refundRequest.vue';
import ReleaseRequest from './containers/releaseRequest.vue';
import Escrows from './containers/escrow.vue';
import PayInOut from './containers/payinout.vue';
import PayOuts from './containers/payouts.vue';
import Invoice from './containers/invoice.vue';
import Companies from './containers/companies.vue';
import Users from './containers/users.vue';
//import PortalIncome from './containers/portalIncome.vue';
import ClientIncome from './containers/clientIncome.vue';
import Languages from './containers/languages.vue';
import Settings from './containers/settings.vue';
import CompanyType from './containers/companyType.vue';
import AddCountries from './containers/addCountries.vue';
import Adminstrator from './containers/adminstrator.vue';
import TextModule from './containers/textModule.vue';
import Reasons from './containers/reasons.vue';
//import PolicyTerms from './containers/policyTerms.vue';
import Services from './containers/services.vue';
import ServiceComission from './containers/serviceCommision.vue';
import Account from './containers/account.vue';
import Post from './containers/posting.vue';
import CallCenter from './containers/callCenter.vue';
import Bids from './containers/bids.vue';


// Routes
const routes = [
    {
        path: '/login',
        name: 'login',
        component: Login,
        meta: {
            auth: false
        }
    },
    {
        path: '/',
        redirect: '/login',
        meta: {
            auth: false
        }
    },
    {
        path: '/main',
        name: 'main',
        component: Main,
        meta: {
            auth: true
        }
    },
    {
        path: '/dashboard',
        name: 'dashboard',
        component: Dashboard,
        meta: {
            auth: true
        }
    },
    {
        path: '/request',
        component: Request,
    },
    {
        path: '/projects',
        component: Projects,
    },
    {
        path: '/contracts',
        component: Contracts,
    },
    // {
    //     path: '/reviews',
    //     component: Reviews,
    // },
    {
        path: '/appointments',
        component: Appointments,
    },
    {
        path: '/purchase',
        component: Purchase,
    },
    {
        path: '/sale-history',
        component: Sale,
    },
    {
        path: '/search-jobs',
        component: SearchJobs,
    },
    {
        path: '/job-offers',
        component: JobOffer,
    },
    {
        path: '/discount',
        component: Discount,
    },
    {
        path: '/upfront-request',
        component: UpfrontRequest,
    },
    {
        path: '/refund-request',
        component: RefundRequest,
    },
    {
        path: '/release-request',
        component: ReleaseRequest,
    },
    {
        path: '/escrows',
        component: Escrows,
    },
    {
        path: '/pay-in-pay-out',
        component: PayInOut,
    },
    {
        path: '/payouts',
        component: PayOuts,
    },
    {
        path: '/invoice',
        component: Invoice,
    },
    {
        path: '/companies',
        component: Companies,
    },
    {
        path: '/users',
        component: Users,
    },
    // {
    //     path: '/portal-income',
    //     component: PortalIncome,
    // },
    {
        path: '/client-income',
        component: ClientIncome,
    },
    {
        path: '/languages',
        component: Languages,
    },
    {
        path: '/settings',
        component: Settings,
    },
    {
        path: '/company-type',
        component: CompanyType,
    },
    {
        path: '/add-countrys',
        component: AddCountries,
    },
    {
        path: '/administrator',
        component: Adminstrator,
    },
    {
        path: '/text-module',
        component: TextModule,
    },
    {
        path: '/reasons',
        component: Reasons,
    },
    // {
    //     path: '/policy-terms',
    //     component: PolicyTerms,
    // },
    {
        path: '/services',
        component: Services,
    },
    {
        path: '/service-comission',
        component: ServiceComission,
    },
    {
        path: '/account',
        component: Account,
    },
    {
        path: '/posting',
        component: Post,
    },
    {
        path: '/call-center',
        component: CallCenter,
    },
    {
        path: '/bids',
        component: Bids,
    },
];


const router = new VueRouter({
    history: true,
    mode: 'history',
    routes,
})

export default router
