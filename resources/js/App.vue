<template>
    <div class="vd_body">
        <Header />
        <div class="content">
            <div class="container">
                <DBComponent />
               <Dashboard/>
                <RightMenu />
            </div>
        </div>
        <Footer />
    </div>
<!--<a id="back-top" href="#" data-action="backtop" class="vd_back-top visible"> <i class="fa  fa-angle-up"> </i> </a>-->
</template>

<script>

import './assets/js/jquery.js'
// import './assets/plugins/isotope/isotope.pkgd.min.js';

import DBComponent from './containers/dashboard/DBComponent.vue';
import Header from './containers/Header/HeaderComponent.vue'
// import Main from './containers/Main/MainComponent.vue'
// import RequestPage from './containers/RequestPage/RequestPageComponent.vue'
import RightMenu from './containers/RightMenu/RightMenuComponent.vue'
import Dashboard from './containers/Main/MainComponent.vue'

import Footer from './containers/Footer/FooterComponent.vue'
import './assets/plugins/imgSelect/chosen.jquery.min.js'
import './assets/plugins/imgSelect/ImageSelect.jquery.js'

export default {
  name: 'app',
  components: {
    DBComponent,
      Dashboard,
	Header,
	RightMenu,
	Footer,
  },
  methods:{
    addScript:(src) =>{
        // console.info(src)
      const s = document.createElement('script');
      s.src= src;
      s.type = 'text/javascript';
        //console.info(s)
      document.body.appendChild(s)
    }
	},

  mounted(){
//
    this.addScript('/plugins/jquery-ui/jquery-ui.custom.min.js')
	this.addScript('/plugins/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js')

    this.addScript('/js/caroufredsel.js')
	this.addScript('/js/plugins.js')

	this.addScript('/js/bootstrap.min.js')

    this.addScript('/plugins/breakpoints/breakpoints.js')
    this.addScript('/plugins/dataTables/jquery.dataTables.min.js')
	this.addScript('/plugins/prettyPhoto-plugin/js/jquery.prettyPhoto.js')

    this.addScript('/plugins/tagsInput/jquery.tagsinput.min.js')
    this.addScript('/plugins/bootstrap-switch/bootstrap-switch.min.js')
    this.addScript('/plugins/blockUI/jquery.blockUI.js')
    this.addScript('/plugins/pnotify/js/jquery.pnotify.min.js')
    this.addScript('/js/theme.js')
	this.addScript('/custom/custom.js')

    this.addScript('/plugins/flot/jquery.flot.min.js')
    this.addScript('/plugins/flot/jquery.flot.resize.min.js')
    this.addScript('/plugins/flot/jquery.flot.pie.min.js')
    this.addScript('/plugins/flot/jquery.flot.categories.min.js')
    this.addScript('/plugins/flot/jquery.flot.time.min.js')
	this.addScript('/plugins/flot/jquery.flot.animator.min.js')

    this.addScript('/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')
    this.addScript('/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')
    this.addScript('/plugins/moment/moment.min.js')
    this.addScript('/plugins/fullcalendar/fullcalendar.min.js')
    this.addScript('/plugins/introjs/js/intro.min.js')
	this.addScript('/plugins/skycons/skycons.js')


    this.addScript('/plugins/isotope/isotope.pkgd.min.js')
    // this.addScript('/plugins/imgSelect/chosen.jquery.min.js')
	// this.addScript('/plugins/imgSelect/ImageSelect.jquery.js')

    this.addScript('/plugins/bootstrap-timepicker/bootstrap-timepicker.min.js')
    this.addScript('/plugins/daterangepicker/daterangepicker.js')
    this.addScript('/plugins/colorpicker/colorpicker.js')
	this.addScript('/plugins/ckeditor/ckeditor.js')

    this.addScript('/plugins/ckeditor/adapters/jquery.js')
    this.addScript('/plugins/bootstrap-wysiwyg/js/wysihtml5-0.3.0.min.js')
	this.addScript('/plugins/bootstrap-wysiwyg/js/bootstrap-wysihtml5-0.0.2.js')


	$('#gen').click(function gen() {
					if ($('#generate').val() > 0) {

						$('#generate').val();
						$('#generate').val((Math.floor((Math.random() * 100 * 1000000) + 1)));

					}
					else {
						$('#generate').val((Math.floor((Math.random() * 100 * 1000000) + 1)));
					}
				})
	$(document).ready(function(){
	  $(".langSelect").chosen();

	  function leftMenuHeight(){
	    var nbHeight = $('.vd_navbar-left .navbar-tabs-menu').outerHeight();
	    var hdrHeight = $('.vd_navbar-left h3.menu-title').outerHeight();
	    var nbrPadding = $('.vd_navbar-left').css('padding-top').replace("px", "");
	    var btmHeight = $('.vd_navbar-left .vd_navbar-bottom-widget').outerHeight();
	    var navbrHeight = $('.vd_navbar-left').height();
	    var menuRowHeight = $('.scrolled-menu li').outerHeight() + 1;//1 for border
	    var unusedHeight = (navbrHeight - nbHeight - hdrHeight - btmHeight - nbrPadding) % menuRowHeight;
	    var placeForMenu = (navbrHeight - nbHeight - hdrHeight - btmHeight - nbrPadding) - unusedHeight; //1

	    $('.scrolled-menu').height(placeForMenu);
	  };

	  leftMenuHeight();

	  $(window).resize(function() {
	    leftMenuHeight();
	  });

	  $('.nav-medium-button').click(function(){
	    leftMenuHeight();
	  });

	});
    $(window).on('load', function()      {



          $('.scrolled-menu').mCustomScrollbar({
              scrollInertia:300,
              autoDraggerLength: false,
              advanced:{ updateOnContentResize: true }

          });

          $('.scrolled-comments').mCustomScrollbar({
              scrollInertia:300,
              autoDraggerLength: false,
              advanced:{ updateOnContentResize: true }

          });


          $.fn.UseTooltip = function () {
              var previousPoint = null;

              $(this).bind("plothover", function (event, pos, item) {
                  if (item) {
                      if (previousPoint != item.dataIndex) {

                          previousPoint = item.dataIndex;

                          $("#tooltip").remove();
                          var x = item.datapoint[0].toFixed(2),
                              y = item.datapoint[1].toFixed(2);

                          showTooltip(item.pageX, item.pageY,
                              "<p class='vd_bg-green'><strong class='mgr-10 mgl-10'>" + Math.round(x)  + " NOV 2013 </strong></p>" +
                              "<div style='padding: 0 10px 10px;'>" +
                              "<div>" + item.series.label +": <strong>"+ Math.round(y)  +"</strong></div>" +
                              "<div> Profit: <strong>$"+ Math.round(y)*7  +"</strong></div>" +
                              "</div>"
                          );
                      }
                  } else {
                      $("#tooltip").remove();
                      previousPoint = null;
                  }
              });
          };

          function showTooltip(x, y, contents) {
              $('<div id="tooltip">' + contents + '</div>').css({
                  position: 'absolute',
                  display: 'none',
                  top: y + 5,
                  left: x + 20,
                  size: '10',
//				'border-top' : '3px solid #1FAE66',
                  'background-color': '#111111',
                  color: "#FFFFFF",
                  opacity: 0.85
              }).appendTo("body").fadeIn(200);
          }


          /* REVENUE LINE CHART */

          var d2 = [ [1, 250],
              [2, 150],
              [3, 50],
              [4, 200],
              [5,50],
              [6, 150],
              [7, 150],
              [8, 200],
              [9, 100],
              [10, 250],
              [11,250],
              [12, 200],
              [13, 300]

          ];
          var d1 = [
              [1, 650],
              [2, 550],
              [3, 450],
              [4, 550],
              [5, 350],
              [6, 500],
              [7, 600],
              [8, 450],
              [9, 300],
              [10, 600],
              [11, 400],
              [12, 500],
              [13, 700]

          ];
          var plot = $.plotAnimator($("#revenue-line-chart"), [
              {  	label: "Revenue",
                  data: d2,
                  lines: {
                      fill: 0.4,
                      lineWidth: 0,
                  },
                  color:['#f2be3e']
              },{
                  data: d1,
                  animator: {steps: 60, duration: 1000, start:0},
                  lines: {lineWidth:2},
                  shadowSize:0,
                  color: '#F85D2C'
              },{
                  label: "Revenue",
                  data: d1,
                  points: { show: true, fill: true, radius:6,fillColor:"#F85D2C",lineWidth:3 },
                  color: '#fff',
                  shadowSize:0
              },
              {	label: "Cost",
                  data: d2,
                  points: { show: true, fill: true, radius:6,fillColor:"#f2be3e",lineWidth:3 },
                  color: '#fff',
                  shadowSize:0
              }
          ],{	xaxis: {
                  tickLength: 0,
                  tickDecimals: 0,
                  min:2,

                  font :{
                      lineHeight: 13,
                      style: "normal",
                      weight: "bold",
                      family: "sans-serif",
                      variant: "small-caps",
                      color: "#6F7B8A"
                  }
              },
              yaxis: {
                  ticks: 3,
                  tickDecimals: 0,
                  tickColor: "#f0f0f0",
                  font :{
                      lineHeight: 13,
                      style: "normal",
                      weight: "bold",
                      family: "sans-serif",
                      variant: "small-caps",
                      color: "#6F7B8A"
                  }
              },
              grid: {
                  backgroundColor: { colors: [ "#fff", "#fff" ] },
                  borderWidth:1,borderColor:"#f0f0f0",
                  margin:0,
                  minBorderMargin:0,
                  labelMargin:20,
                  hoverable: true,
                  clickable: true,
                  mouseActiveRadius:6
              },
              legend: { show: false}
          });

          $("#revenue-line-chart").UseTooltip();

          $(window).on("resize", function(){
              plot.resize();
              plot.setupGrid();
              plot.draw();
          });


          /* REVENUE DONUT CHART */

          var data2 = [],
              series = 3;
          var data2 = [
              { label: "Men",  data: 35},
              { label: "Women",  data: 65}
          ];
          var revenue_donut_chart = $("#revenue-donut-chart");

          $("#revenue-donut-chart").bind("plotclick", function (event, pos, item) {
              if (item) {
                  $("#clickdata").text(" - click point " + item.dataIndex + " in " + item.series.label);
                  plot.highlight(item.series, item.datapoint);
              }
          });
          $.plot(revenue_donut_chart, data2, {
              series: {
                  pie: {
                      innerRadius: 0.4,
                      show: true
                  }
              },
              grid: {
                  hoverable: true,
                  clickable: true,
              },
              colors: ["#1FAE66", "#F85D2C "]
          });


          /* REVENUE BAR CHART */

          var bar_chart_data = [ ["Jan", 10], ["Feb", 8], ["Mar", 4], ["Apr", 13], ["May", 17], ["Jun", 9], ["Jul", 10], ["Aug", 8], ["Sep", 4], ["Oct", 13], ["Nov", 17], ["Dec", 9] ];

          var bar_chart = $.plot(
              $("#revenue-bar-chart"), [{
                  data: bar_chart_data,
                  //           color: "rgba(31,174,102, 0.8)",
                  color: "#F85D2C" ,
                  shadowSize: 0,
                  bars: {
                      show: true,
                      lineWidth: 0,
                      fill: true,
                      fillColor: {
                          colors: [{
                              opacity: 1
                          }, {
                              opacity: 1
                          }]
                      }
                  }
              }], {
                  series: {
                      bars: {
                          show: true,
                          barWidth: 0.9,
                          align: "center"
                      }
                  },
                  grid: {
                      show: true,
                      hoverable: true,
                      borderWidth: 0
                  },
                  yaxis: {
                      min: 0,
                      max: 20,
                      show: false
                  },
                  xaxis: {
                      mode: "categories",
                      tickLength: 0,
                      color: "#FFFFFF",
                  }
              });

          var previousPoint2 = null;
          $("#revenue-bar-chart").bind("plothover", function (event, pos, item) {
              $("#x").text(pos.x.toFixed(2));
              $("#y").text(pos.y.toFixed(2));
              if (item) {
                  if (previousPoint2 != item.dataIndex) {
                      previousPoint2 = item.dataIndex;
                      $("#tooltip").remove();
                      var x = item.datapoint[0] + 1,
                          y = item.datapoint[1].toFixed(2);
                      showTooltip(item.pageX, item.pageY,
                          "<p class='vd_bg-green'><strong class='mgr-10 mgl-10'>" + x + " - 2013 </strong></p>" +
                          "<div style='padding: 0 10px 10px;'>" +
                          "<div> Sales: <strong>"+ Math.round(y)*17  +"</strong></div>" +
                          "<div> Profit: <strong>$"+ Math.round(y)*280  +"</strong></div>" +
                          "</div>"
                      );
                  }
              }
          });

          $('#revenue-bar-chart').bind("mouseleave", function () {
              $("#tooltip").remove();
          });



          /* FULL CALENDAR  */

          var date = new Date();
          var d = date.getDate();
          var m = date.getMonth();
          var y = date.getFullYear();

          $('#calendar').fullCalendar({
              header: {
                  left:   'title',
                  center: '',
                  right:  'today prev,next'
              },
              editable: true,
              events: [
                  {
                      title: 'All Day Event',
                      start: new Date(y, m, 1)
                  },
                  {
                      title: 'Long Event',
                      start: new Date(y, m, d-5),
                      end: new Date(y, m, d-2)
                  },
                  {
                      id: 999,
                      title: 'Repeating Event',
                      start: new Date(y, m, d-3, 16, 0),
                      allDay: false
                  },
                  {
                      id: 999,
                      title: 'Repeating Event',
                      start: new Date(y, m, d+4, 16, 0),
                      allDay: false
                  },
                  {
                      title: 'Meeting',
                      start: new Date(y, m, d, 10, 30),
                      allDay: false
                  },
                  {
                      title: 'Lunch',
                      start: new Date(y, m, d, 12, 0),
                      end: new Date(y, m, d, 14, 0),
                      allDay: false
                  },
                  {
                      title: 'Birthday Party',
                      start: new Date(y, m, d+1, 19, 0),
                      end: new Date(y, m, d+1, 22, 30),
                      allDay: false
                  },
                  {
                      title: 'Click for Google',
                      start: new Date(y, m, 28),
                      end: new Date(y, m, 29),
                      url: 'http://google.com/'
                  }
              ]
          });


// Skycons

          var icons = new Skycons({"color": "white","resizeClear": true}),
              icons_btm = new Skycons({"color": "#F89C2C","resizeClear": true}),
              list  = "clear-day",
              livd_btm = ["rain", "wind"
              ];
          icons.set(list,list)
          for(var i = livd_btm.length; i--; )
              icons_btm.set(livd_btm[i], livd_btm[i]);

          icons.play();
          icons_btm.play();

          /* News Widget */
          $(".vd_news-widget .vd_carousel").carouFredSel({
              prev:{
                  button : function()
                  {
                      return $(this).parent().parent().children('.vd_carousel-control').children('a:first-child')
                  }
              },
              next:{
                  button : function()
                  {
                      return $(this).parent().parent().children('.vd_carousel-control').children('a:last-child')
                  }
              },
              scroll: {
                  fx: "crossfade",
                  onBefore: function(){
                      var target = "#front-1-clients";
                      $(target).css("transition","all .5s ease-in-out 0s");
                      if ($(target).hasClass("vd_bg-soft-yellow")){
                          $(target).removeClass("vd_bg-soft-yellow");
                          $(target).addClass("vd_bg-soft-red");
                      } else
                      if ($(target).hasClass("vd_bg-soft-red")){
                          $(target).removeClass("vd_bg-soft-red");
                          $(target).addClass("vd_bg-soft-blue");
                      } else
                      if ($(target).hasClass("vd_bg-soft-blue")){
                          $(target).removeClass("vd_bg-soft-blue");
                          $(target).addClass("vd_bg-soft-green");
                      } else
                      if ($(target).hasClass("vd_bg-soft-green")){
                          $(target).removeClass("vd_bg-soft-green");
                          $(target).addClass("vd_bg-soft-yellow");
                      }
                  }
              },
              width: "auto",
              height: "responsive",
              responsive: true,
              auto:3000

          });



          // Notification
      });
  }
}
</script>

<style>
@import "./assets/css/bootstrap.min.css";
@import "./assets/css/font-awesome.min.css";
@import "./assets/css/font-entypo.css";
@import "./assets/css/fonts.css";
@import "./assets/plugins/isotope/css/isotope.css";

@import "./assets/plugins/jquery-ui/jquery-ui.custom.min.css";
@import "./assets/plugins/prettyPhoto-plugin/css/prettyPhoto.css";
@import "./assets/plugins/isotope/css/isotope.css";
@import "./assets/plugins/pnotify/css/jquery.pnotify.css";
@import "./assets/plugins/google-code-prettify/prettify.css";

@import "./assets/plugins/isotope/css/isotope.css";

@import "./assets/plugins/mCustomScrollbar/jquery.mCustomScrollbar.css";
@import "./assets/plugins/tagsInput/jquery.tagsinput.css";
@import "./assets/plugins/bootstrap-switch/bootstrap-switch.css";
@import "./assets/plugins/daterangepicker/daterangepicker-bs3.css";
@import "./assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.css";
@import "./assets/plugins/colorpicker/css/colorpicker.css";
@import "./assets/plugins/imgSelect/ImageSelect.css";
@import "./assets/plugins/imgSelect/Flat.css";
@import "./assets/plugins/imgSelect/chosen.css";

@import "./assets/plugins/fullcalendar/fullcalendar.css";

@import "./assets/css/theme-responsive.min.css";


@import "./assets/custom/custom.css";
@import "./assets/css/theme.css";
</style>


