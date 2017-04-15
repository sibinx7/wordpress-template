$(document).ready(function(){
  // Home Slider with LightSlider
  var homeSliderElement = $('#home-slider-element');
  if(homeSliderElement.length > 0){
    homeSliderElement.slick({
      slidesToShow:1,
      prevArrow:'<button class="slick-prev slick-arrow"><span class="fa fa-chevron-left"></span></button>',
      nextArrow:'<button class="slick-next slick-arrow"><span class="fa fa-chevron-right"></span></button>'
    })
  }

  // Odo meter number counters
  var yearElementNum        = $('#year-history-num');
  var projectDeliveredNum   = $('#project-delivered-num');
  var ofBuiltAreaNum        = $('#of-built-area-num');
  var effectNum          = $('#effect-num');


  if(yearElementNum.length > 0){
    var yearElementObj     = new Odometer({
      el: yearElementNum[0],
      value:0,
      format:''
    });
    yearElementObj.update(30);
  }

  if(projectDeliveredNum.length > 0){
    var projectElementObj = new Odometer({
      el:projectDeliveredNum[0],
      value:0,
      format:''
    });
    projectElementObj.update(1120)
  }
  if(ofBuiltAreaNum.length > 0){
    var ofBuiltObj = new Odometer({
      el:ofBuiltAreaNum[0],
      value:0,
      format:''
    });
    ofBuiltObj.update(1114);
  }

  if(effectNum.length > 0){
    var effectNumObj = new Odometer({
      el:effectNum[0],
      value:0,
      format:''
    });
    effectNumObj.update(1870)
  }

  //  Client slider
  var homeClientListEle = $('#h-client-list');
  if(homeClientListEle.length > 0){
    homeClientListEle.slick({
      slidesToShow: 6,
      infinite: true,
      prevArrow:'<button class="slick-arrow slick-prev"><span class="fa fa-angle-left"></span></button>',
      nextArrow:'<button class="slick-arrow slick-next"><span class="fa fa-angle-right"></span></button>',
      responsive :[
        {
          breakpoint:454,
          settings:{
            slidesToShow:1
          }
        },
        {
          breakpoint: 768,
          settings:{
            slidesToShow:2
          }
        },
        {
          breakpoint: 992,
          settings:{
            slidesToShow:3
          }
        },
        {
          breakpoint: 1200,
          settings:{
            slidesToShow:4
          }
        }
      ]
    })
  }
});



(function(){
  $(document).ready(function(){
    var ajaxURL = $('.show-jquery-ui-date-picker').data('url');
    var postData = [];
    window.postData = postData;

    /** FOR TESTING **/
    $('#radon-datepicker').datepicker({
      numberOfMonths:2,
      beforeShow: function(){


      },
      onChangeMonthYear: function(year, month, instance){
        var selectedMonthDate = new Date(instance.selectedYear,instance.selectedMonth,instance.selectedDay);
        var changedDateArray = getCurrentMonthFirstAndNextMonthLastDate(selectedMonthDate)
        getDateWiseEvents(changedDateArray)

      },
      onSelect: function(date,instance){
        if($('#radon-desc').children().length > 0){
          $('#radon-desc').children().remove();
        }
        var eventsInDay = _.filter(window.postData, function(value){
          var selectedDate = date.toString()
          var eventStartDate = value['EventStartDate'];
          eventStartDate = moment(eventStartDate).format("MM/DD/YYYY");
          console.log(eventStartDate,'=',selectedDate);
          return eventStartDate === selectedDate;
        });


        if(eventsInDay.length > 0){
          var eventListEle = $('<ul/>',{
            class:'event-list-ul'
          });

          var eventLiEle = _.map(eventsInDay, function(value){
            console.log(value.venueDetails)
            var jsonAddress = JSON.stringify(value.venueDetails);
            console.log(jsonAddress)
            return "<li><h3>"+value.post_title+"</h3>" +
                "<a data-address='"+(jsonAddress)+"' class='google-map' data-title='"+value.post_title+"'><span class='fa fa-map-marker'></span></a>"+
              "</li>"
          })

          eventListEle.append(eventLiEle);
          $('#radon-desc').append(eventListEle);

          if(google){

          }


        }
      }
    });

    var googleMarkerEle = $('.google-map');
    $('body').on('click','.google-map', function(){
      var addressData = $(this).data('address');
      var title       = $(this).data('title');
      var mapModal = $('#google-map-modal');
      var googleMapEle = $('#google-map-element');
      mapModal.find('.modal-title').text(title);
      var address_string = "";
      var address_region = "";
      var address_postcode = "";
      if(addressData.address){
        address_string += addressData.address;
      }
      if(addressData.city){
        addressData += ","+addressData.city;
      }
      if(addressData.country){
        addressData += ","+addressData.country;
      }

      if(addressData.region){
        address_region = addressData.region
      }
      if(addressData.zip){
        address_postcode = addressData.zip;
      }

      var googleAddress = {};

      if(address_string){
        googleAddress['address'] = address_string
      }
      if(address_region){
        googleAddress['region'] = address_region
      }
      if(address_postcode){
        googleAddress['componentRestrictions'] = {
          postalCode:address_postcode
        }
      }
      var geocode = new google.maps.Geocoder();
      geocode.geocode(googleAddress, function(result,status){
        console.log(result,status)
        if(status === "OK"){
          var placeOne = result[0];
          if(placeOne && placeOne.geometry && placeOne.geometry.location){

            var centerPosition = {
              lat: placeOne.geometry.location.lat(),
              lng: placeOne.geometry.location.lng()
            }
            console.log(centerPosition)
            var googleMap = new google.maps.Map(googleMapEle[0],{
              zoom:7,
              center: centerPosition
            });

            window.googleMap = googleMap;

            var googleMarker = new google.maps.Marker({
              position: centerPosition,
              map:googleMap
            })
          }
        }

        mapModal.modal('show');

        window.result = result;
      })

    });

    var datesArray = getCurrentMonthFirstAndNextMonthLastDate()


    getDateWiseEvents(datesArray)

    function getDateWiseEvents(dates){
      $.ajax({
        url:ajaxURL,
        type:"POST",
        data:{
          action:'fetch_all_date_events',
          start_date: dates[0],
          end_date: dates[1]
        },
        success: function(result){

          result = JSON.parse(result);
          if(result.status === 200){
            postData = result.data;
            window.postData = postData
          }
        },
        error: function(error){
          console.log(error)
        }
      });
    }


    function getCurrentMonthFirstAndNextMonthLastDate(date){
      var dateObject;
      if(typeof date === "undefined"){
        dateObject = new Date();
      }else{
        dateObject = new Date(date)
      }

      var currentMonth          = dateObject.getMonth();
      var currentStartDate      = new Date(dateObject.getFullYear(),currentMonth,1);
      var nextMonthLastDate     = new Date(dateObject.getFullYear(),currentMonth+2,0);

      currentStartDate          = $.datepicker.formatDate('yy-mm-dd',currentStartDate);
      nextMonthLastDate         = $.datepicker.formatDate('yy-mm-dd',nextMonthLastDate);

      console.log(currentStartDate,nextMonthLastDate)

      console.log([currentStartDate,nextMonthLastDate])
      return [currentStartDate,nextMonthLastDate]
    }
    /** END TESTING **/
  })
})();


