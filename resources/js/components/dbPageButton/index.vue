<template>
        <div class="vd_menu scrolled-menu">
        
      <ul>
					<li v-bind:class="(this.pathname == '/') && 'active'">
						<a href="/">
							<span class="menu-icon"><i class="fa fa-dashboard"></i></span>
							<span class="menu-text">Dashboard</span>
						</a>
					</li>
					<li v-bind:class="(this.pathname == '/request') && 'active'">
						<a href="/request">
							<span class="menu-icon"><i class="fa fa-flag-o"></i></span>
							<span class="menu-text">New Request</span>
						</a>
					</li>
					<li  v-bind:class="(this.pathname == '/ticket/index.html' ||this.pathname == '/Live_Chat/livechat/index.html') && 'active'">
						<a href="javascript:void(0);" data-action="click-trigger" class="open">
							<span class="menu-icon"><i class="fa fa-files-o"></i></span>
							<span class="menu-text">Reports</span>
							<span class="menu-badge"><span class="badge vd_bg-black-30"><i class="fa fa-angle-down"></i></span></span>
						</a>
						<div class="child-menu" data-action="click-target" v-bind:style="(this.pathname == '/ticket/index.html' || this.pathname == '/Live_Chat/livechat/index.html') && 'display:block;'">
							<ul>
								<li v-bind:class="(this.pathname == '/ticket/index.html') && 'active'">
									<a href="../../ticket/index.html" target="_blank"><span class="menu-text"><span class="append-icon icon-paperplane"></span> Ticket</span></a>
								</li>
								<li v-bind:class="(this.pathname == '/Live_Chat/livechat/index.html') && 'active'">
									<a href="../../Live_Chat/livechat/index.html" target="_blank"><span class="menu-text"><span class="append-icon icon-chat"></span> Live Chat</span></a>
								</li>
							</ul>
						</div>
					</li>
					<li v-bind:class="(this.pathname == '/projects' || this.pathname == '/contracts' ||
						this.pathname == '/reviews' ||
						this.pathname == '/appointments'||
						this.pathname == '/purchase'||
						this.pathname == '/sale-history' ||
						this.pathname == '/search-jobs' ||
						this.pathname == '/job-offers') 
						&& 'active'">
						
						<a href="javascript:void(0);" data-action="click-trigger">
							<span class="menu-icon"><i class="fa fa-cubes"></i></span>
							<span class="menu-text">Activity</span>
							<span class="menu-badge"><span class="badge vd_bg-black-30"><i class="fa fa-angle-down"></i></span></span>
						</a>
						<div class="child-menu" data-action="click-target" v-bind:style="(this.pathname == '/projects' || this.pathname == '/contracts' ||
						this.pathname == '/reviews' ||
						this.pathname == '/appointments'||
						this.pathname == '/purchase'||
						this.pathname == '/sale-history' ||
						this.pathname == '/search-jobs' ||
						this.pathname == '/job-offers') 
						&& 'display:block;'">
							<ul>
								<li v-bind:class="(this.pathname == '/projects') && 'active'">
									<a href="/projects"><span class="menu-text"><span class="append-icon icon-archive"></span> All Projects</span></a>
								</li>
								<li v-bind:class="(this.pathname == '/contracts') && 'active'">
									<a href="/contracts"><span class="menu-text"><span class="append-icon icon-briefcase"></span> All Contracts</span></a>
								</li>
								<li v-bind:class="(this.pathname == '/reviews') && 'active'">
									<a href="/reviews"><span class="menu-text"><span class="append-icon fa fa-star-half-o"></span> Reviews</span></a>
								</li>
								<li v-bind:class="(this.pathname == '/appointments') && 'active'">
									<a href="/appointments"><span class="menu-text"><span class="append-icon fa fa-calendar"></span> Appointments</span></a>
								</li>
								<li v-bind:class="(
									this.pathname == '/purchase'||
									this.pathname == '/sale-history') 
									&& 'active'">
									<a href="javascript:void(0);" data-action="click-trigger" class=""> 
										<span class="menu-text"><span class="append-icon icon-sharable"></span> Purchase Services</span> 
										<span class="menu-badge"><span class="badge vd_bg-black-30"><i class="fa fa-angle-down"></i></span></span>
									</a> 
									<div class="child-menu" data-action="click-target" v-bind:style="(
									this.pathname == '/purchase'||
									this.pathname == '/sale-history') 
									&& 'display:block;'">
										<ul class="clearfix">
											<li v-bind:class="(this.pathname == '/purchase') && 'active'"> <a href="/purchase"> 
												<span class="menu-text"><span class="append-icon icon-drawer"></span> All Services</span> 
												</a> 
											</li>
											<li v-bind:class="(this.pathname == '/sale-history') && 'active'"> <a href="/sale-history"> 
												<span class="menu-text"><i class="append-icon fa fa-fw fa-history"></i> Sale History</span> 
												</a> 
											</li>
										</ul>
									</div>  
								</li>
								<li v-bind:class="(
									this.pathname == '/search-jobs' ||
									this.pathname == '/job-offers') 
									&& 'active'">
									<a href="javascript:void(0);" data-action="click-trigger" class=""> 
										<span class="menu-text"><span class="append-icon icon-graduation"></span> Jobs</span> 
										<span class="menu-badge"><span class="badge vd_bg-black-30"><i class="fa fa-angle-down"></i></span></span>
									</a> 
									<div class="child-menu" data-action="click-target" v-bind:style="(
									this.pathname == '/search-jobs' ||
									this.pathname == '/job-offers') 
									&& 'display:block;'">
										<ul class="clearfix">
											<li v-bind:class="(this.pathname == '/search-jobs') && 'active'"> <a href="/search-jobs"> 
												<span class="menu-text"><i class="append-icon glyphicon glyphicon-zoom-in"></i> Search Jobs</span> 
												</a> 
											</li>
											<li v-bind:class="(this.pathname == '/job-offers') && 'active'"> <a href="/job-offers"> 
												<span class="menu-text"><span class="append-icon icon-megaphone"></span> Job Offers</span> 
												</a> 
											</li>
										</ul>
									</div>  
								</li>
							</ul>
						</div>
					</li>
					<li v-bind:class="(this.pathname == '/assets/emaileditor/login.php.html' || this.pathname == '/discount' ) 
						&& 'active'">
						<a href="javascript:void(0);" data-action="click-trigger">
							<span class="menu-icon"><i class="fa fa-bar-chart-o"></i></span>
							<span class="menu-text">Marketing</span>
							<span class="menu-badge"><span class="badge vd_bg-black-30"><i class="fa fa-angle-down"></i></span></span>
						</a>
						<div class="child-menu" data-action="click-target"  v-bind:style="(this.pathname == '/assets/emaileditor/login.php.html' || this.pathname == '/discount' ) 
						&& 'display:block;'">
							<ul>
								<li v-bind:class="(this.pathname == '/assets/emaileditor/login.php.html') && 'active'">
									<a href="../../assets/emaileditor/login.php.html" target="_blank"><span class="menu-text"><i class="append-icon fa fa-fw fa-envelope"></i> News Letter</span></a>
								</li>
								<li>
									<a href="javascript:void(0);"><span class="menu-text"><i class="append-icon glyphicon glyphicon-comment"></i> Popups Settings</span></a>
								</li>
								<li v-bind:class="(this.pathname == '/discount') && 'active'">
									<a href="/discount"><span class="menu-text"><i class="append-icon glyphicon glyphicon-tags"></i> Discount</span></a>
								</li>
							</ul>
						</div>
					</li>
					<li v-bind:class="(this.pathname == '/upfront-request' || this.pathname == '/refund-request' ||
						this.pathname == '/release-request' ||
						this.pathname == '/escrows'||
						this.pathname == '/pay-in-pay-out'||
						this.pathname == '/payouts' ||
						this.pathname == '/invoice' )
						&& 'active'">
						<a href="javascript:void(0);" data-action="click-trigger">
							<span class="menu-icon"><i class="fa fa-credit-card"></i></span>
							<span class="menu-text">Payments</span>
							<span class="menu-badge"><span class="badge vd_bg-black-30"><i class="fa fa-angle-down"></i></span></span>
						</a>
						<div class="child-menu" data-action="click-target" v-bind:style="(this.pathname == '/upfront-request' || this.pathname == '/refund-request' ||
						this.pathname == '/release-request' ||
						this.pathname == '/escrows'||
						this.pathname == '/pay-in-pay-out'||
						this.pathname == '/payouts' ||
						this.pathname == '/invoice' )
						&& 'display:block;'">
							<ul>
								<li v-bind:class="(this.pathname == '/upfront-request') && 'active'">
									<a href="/upfront-request"><span class="menu-text"><span class="append-icon icon-arrow-up2"></span> Upfront Request</span></a>
								</li>
								<li v-bind:class="(this.pathname == '/refund-request') && 'active'">
									<a href="/refund-request"><span class="menu-text"><span class="append-icon icon-cycle"></span> Refund Request</span></a>
								</li>
								<li v-bind:class="(this.pathname == '/release-request') && 'active'">
									<a href="/release-request"><span class="menu-text"><span class="append-icon icon-target"></span> Release Request</span></a>
								</li>
								<li v-bind:class="(this.pathname == '/escrows') && 'active'">
									<a href="/escrows"><span class="menu-text"><span class="append-icon icon-cw"></span> Escrow Accounts</span></a>
								</li>
								<li v-bind:class="(this.pathname == '/pay-in-pay-out') && 'active'">
									<a href="/pay-in-pay-out"><span class="menu-text"><span class="append-icon icon-credit-card"></span> PayIn / PayOut Accounts</span></a>
								</li>
								<li v-bind:class="(this.pathname == '/payouts') && 'active'">
									<a href="/payouts"><span class="menu-text"><span class="append-icon icon-add-to-list"></span> Payouts</span></a>
								</li>
								<li v-bind:class="(this.pathname == '/invoice') && 'active'">
									<a href="/invoice"><span class="menu-text"><span class="append-icon icon-info2"></span> Invoice</span></a>
								</li>
							</ul>
						</div>
					</li>
					<li v-bind:class="(this.pathname == '/companies' || this.pathname == '/users')
						&& 'active'">
						<a href="javascript:void(0);" data-action="click-trigger">
							<span class="menu-icon"><i class="fa fa-users"></i></span>
							<span class="menu-text">Customer</span>
							<span class="menu-badge"><span class="badge vd_bg-black-30"><i class="fa fa-angle-down"></i></span></span>
						</a>
						<div v-bind:style="(this.pathname == '/companies' || this.pathname == '/users')
						&& 'display:block;'" class="child-menu" data-action="click-target">
							<ul>
								<li v-bind:class="(this.pathname == '/companies') && 'active'">
									<a href="/companies"><span class="menu-text"><span class="append-icon icon-vcard"></span> Portal Clients</span></a>
								</li>
								<li v-bind:class="(this.pathname == '/users') && 'active'">
									<a href="/users"><span class="menu-text"><span class="append-icon icon-users"></span> Portal Users</span></a>
								</li>
							</ul>
						</div>
					</li>
					<li v-bind:class="(this.pathname == '/portal-income' || this.pathname == '/client-income')
						&& 'active'">
						<a href="javascript:void(0);" data-action="click-trigger">
							<span class="menu-icon"><i class="fa fa-money"></i></span>
							<span class="menu-text">Income</span>
							<span class="menu-badge"><span class="badge vd_bg-black-30"><i class="fa fa-angle-down"></i></span></span>
						</a>
						<div class="child-menu" data-action="click-target" v-bind:style="(this.pathname == '/portal-income' || this.pathname == '/client-income')
						&& 'display:block;'">
							<ul>
								<li v-bind:class="(this.pathname == '/portal-income') && 'active'">
									<a href="/portal-income"><span class="menu-text"><i class="append-icon fa fa-fw fa-check-square-o"></i> Portal Income</span></a>
								</li>
								<li v-bind:class="(this.pathname == '/client-income') && 'active'">
									<a href="/client-income"><span class="menu-text"><i class="append-icon fa fa-fw fa-check"></i> Client Income</span></a>
								</li>
							</ul>
						</div>
					</li>
					<li  v-bind:class="(this.pathname == '/languages' || this.pathname == '/settings' ||
						this.pathname == '/company-type' ||
						this.pathname == '/add-countrys'||
						this.pathname == '/administrator'||
						this.pathname == '/text-module' ||
						this.pathname == '/policy-terms' ||
						this.pathname == '/services' ||
						this.pathname == '/service-commission' ||
						this.pathname == '/account' ||
						this.pathname == '/posting' ||
						this.pathname == '/call-center' ||
						this.pathname == '/bids' ||
						this.pathname == '/reasons' )
						&& 'active'">
						<a href="javascript:void(0);" data-action="click-trigger">
							<span class="menu-icon"><i class="fa fa-gear"></i></span>
							<span class="menu-text">Portal Settings</span>
							<span class="menu-badge"><span class="badge vd_bg-black-30"><i class="fa fa-angle-down"></i></span></span>
						</a>
						<div  v-bind:style="(this.pathname == '/languages' || this.pathname == '/settings' ||
						this.pathname == '/company-type' ||
						this.pathname == '/add-countrys'||
						this.pathname == '/administrator'||
						this.pathname == '/text-module' ||
						this.pathname == '/policy-terms' ||
						this.pathname == '/services' ||
						this.pathname == '/service-comission' ||
						this.pathname == '/account' ||
						this.pathname == '/posting' ||
						this.pathname == '/call-center' ||
						this.pathname == '/bids' ||
						this.pathname == '/reasons' )
						&& 'display:block'" class="child-menu" data-action="click-target">
							<ul>
								<li v-bind:class="(this.pathname == '/languages') && 'active'">
									<a href="/languages"><span class="menu-text"><span class="append-icon icon-language"></span> Website Languages</span></a>
								</li>
								<li v-bind:class="(this.pathname == '/settings') && 'active'">
									<a href="/settings"><span class="menu-text"><i class="append-icon fa fa-fw fa-gears"></i> Website Settings</span></a>
								</li>
								<li v-bind:class="(this.pathname == '/company-type') && 'active'">
									<a href="/company-type"><span class="menu-text"><i class="append-icon fa fa-fw fa-asterisk"></i> Company Type</span></a>
								</li>				
								<li v-bind:class="(this.pathname == '/add-countrys') && 'active'">
									<a href="/add-countrys">
										<span class="menu-text">
											<i class="append-icon glyphicon glyphicon-tags"></i> Add Countrys</span>
									</a>
								</li>
								<li v-bind:class="(this.pathname == '/administrator') && 'active'">
									<a href="/administrator"><span class="menu-text"><span class="append-icon icon-user"></span> Admin</span></a>
								</li>
								<li v-bind:class="(this.pathname == '/text-module') && 'active'">
									<a href="/text-module"><span class="menu-text"><i class="append-icon fa fa-fw fa-file-text-o"></i> Text Module</span></a>
								</li>
								<li v-bind:class="(this.pathname == '/reasons') && 'active'">
									<a href="/reasons"><span class="menu-text"><i class="append-icon fa fa-fw fa-sort-amount-asc"></i> Reasons</span></a>
								</li>
								<li v-bind:class="(this.pathname == '/policy-terms') && 'active'">
									<a href="/policy-terms"><span class="menu-text"><i class="append-icon fa fa-fw fa-gavel"></i> Policy&amp;Terms</span></a>
								</li>
								<li v-bind:class="(this.pathname == '/services') && 'active'">
									<a href="/services"><span class="menu-text"><i class="append-icon glyphicon glyphicon-qrcode"></i> Our Services</span></a>
								</li>
								<li v-bind:class="(this.pathname == '/service-comission') && 'active'">
									<a href="/service-comission"><span class="menu-text"><i class="append-icon glyphicon glyphicon-usd"></i> Service Comission</span></a>
								</li>
								<li v-bind:class="(this.pathname == '/account') && 'active'">
									<a href="/account"><span class="menu-text"><i class="append-icon fa fa-fw fa-level-up"></i> Account Upgrade Client</span></a>
								</li>
								<li v-bind:class="(this.pathname == '/posting') && 'active'">
									<a href="/posting"><span class="menu-text"><span class="append-icon fa fa-cogs"></span> Company Skill</span></a>
								</li>
								<li v-bind:class="(this.pathname == '/call-center') && 'active'">
									<a href="/call-center"><span class="menu-text"><span class="append-icon fa fa-phone"></span> Call Center</span></a>
								</li>
								<li v-bind:class="(this.pathname == '/bids') && 'active'">
									<a href="/bids"><span class="menu-text"><span class="append-icon icon-database"></span> Bids Amount Client</span></a>
								</li>
							</ul>
						</div>
					</li>
				</ul>
        </div>
</template>


<script>
export default {
  name: 'SideMenu',
  mounted() {
	console.log(window.location.pathname);
	
  },
  data: function(){return{pathname: window.location.pathname}}
}
</script>

