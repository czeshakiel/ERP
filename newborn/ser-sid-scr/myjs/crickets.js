document.addEventListener('DOMContentLoaded', function(){
const totalipd = document.getElementById("totalipd");
const todIpdCount = document.getElementById("todIpdCount");
const apiUrl = 'ser-sid-scr/myphp/fetch_ipd_count.php';

fetch(apiUrl)
  .then(response => response.json())
  .then(data => {
    if (data.ipdCount !== null) {
        totalipd.textContent = data.ipdCount;
    } else {
      totalipd.textContent = 0;
    }

    if(data.todIpdCount !== null) {
      todIpdCount.textContent = data.totalIpdCount;
    } else {
      todIpdCount.textContent = 0;
    }
  })
  .catch(error => {
    console.error("Error fetching ipd data:", error);
  });

  const totalopd = document.getElementById("totalopd");
  const todOpdCount = document.getElementById("todOpdCount");
  const apiUrlopd = 'ser-sid-scr/myphp/fetch_opd_count.php';
  
  fetch(apiUrlopd)
    .then(response => response.json())
    .then(data => {
      if (data.opdCount !== null) {
        totalopd.textContent = data.opdCount;
      } else {
        totalopd.textContent = 0;
      }
  
      if (data.toOpdCount !== null) {
        todOpdCount.textContent = data.todOpdCount;
      } else {
        todOpdCount.textContent = 0;
      }
    })
    .catch(error => {
      console.error("Error fetching opd data:", error);
    });  

const nbScreening = document.getElementById("nbScreening");
const nbHearing = document.getElementById("nbHearing");
const nbAudiometry = document.getElementById("nbAudiometry");
const repeatnewborn = document.getElementById("repeatnewborn");
const apiUrlLab = 'ser-sid-scr/myphp/fetch_newborn_labcount.php';
fetch(apiUrlLab)
  .then(response => response.json())
  .then(data => {
    if (data.newborn_screening_count && data.newborn_hearing_count && data.newborn_audiometry_count && data.newborn_repeat_count) {
      nbScreening.textContent = data.newborn_screening_count;
      nbHearing.textContent = data.newborn_hearing_count;
      nbAudiometry.textContent = data.newborn_audiometry_count;
      repeatnewborn.textContent = data.newborn_repeat_count;
    } else {
      nbScreening.textContent = 0;
      nbHearing.textContent = 0;
      nbAudiometry.textContent = 0;
      repeatnewborn.textContent = 0;
    }
  })
  .catch(error => {
    console.error("Error fetching opd data:", error);
  });


const ths_year = document.getElementById("ths_year");
const ths_year2 = document.getElementById("ths_year2");
const currentDate = new Date();
      ths_year.textContent = currentDate.getFullYear();
      ths_year2.textContent = currentDate.getFullYear();

const ttlnwbrn = document.getElementById('ttlnwbrn');
const nwcnt = document.getElementById('nwcnt');
fetch('ser-sid-scr/myphp/fetchnewbornstats.php')
  .then(response => response.json())
  .then(data => {
    if (data.total_count !== undefined && data.total_count !== null) {
      ttlnwbrn.textContent = data.total_count;
      nwcnt.textContent = data.total_count;
    } else {
      nwcnt.textContent = 0;
      ttlnwbrn.textContent = 0;
    }
  })
  .catch(error => {
    console.error('Error fetching newborn stats:', error);
    ttlnwbrn.textContent = 'Error loading data';
  });

const expdnewbornkit = document.getElementById("expdnewbornkit");
  fetch('ser-sid-scr/myphp/fetch_kittotalcount.php')
    .then(response => response.json())
    .then(data => {
      if (data.kit_count !== undefined && data.kit_count !== null) {
        expdnewbornkit.textContent = data.kit_count;
      } else {
        expdnewbornkit.textContent = 0;
      }
    })
    .catch(error => {
      console.error("Error fetching kit count:", error);
    });
});

// graph/chart statistics js
$(function() {
    "use strict";
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })

    $(document).ready(function() {
      $.ajax({
          url: 'ser-sid-scr/myphp/fetchnewbornstats.php',
          method: 'GET',
          dataType: 'json',
          success: function(data) {
                var boyCount = parseInt(data.boy_count) || 0;
                var girlCount = parseInt(data.girl_count) || 0;
              var options = {
                  align: 'center',
                  chart: {
                      height: 250,
                      type: 'donut',
                      align: 'center',
                  },
                  labels: ['boy', 'girl'],
                  dataLabels: {
                      enabled: false,
                  },
                  legend: {
                      position: 'bottom',
                      horizontalAlign: 'center',
                      show: true,
                  },
                  colors: ['var(--chart-color4)', 'var(--chart-color3)'],
                  series: [boyCount, girlCount],
                  responsive: [{
                      breakpoint: 480,
                      options: {
                          chart: {
                              width: 250
                          },
                          legend: {
                              position: 'bottom'
                          }
                      }
                  }]
              };
  
              var chart = new ApexCharts(document.querySelector("#apexMainCategories"), options);
              chart.render();
          },
          error: function(error) {
              console.error('Error fetching data from the database', error);
          }
      });
  });


  $(document).ready(function() {
    $.ajax({
      url: 'ser-sid-scr/myphp/fetch_newborn_monthlycount.php',
      method: 'GET',
      dataType: 'json',
      success: function(data) {
        var jaIc = parseInt(data.janCountIpd) || 0; var jaOc = parseInt(data.janCountOpd) || 0;
        var feIc = parseInt(data.febCountIpd) || 0; var feOc = parseInt(data.febCountOpd) || 0;
        var maIc = parseInt(data.marCountIpd) || 0; var maOc = parseInt(data.marCountOpd) || 0;
        var apIc = parseInt(data.aprCountIpd) || 0; var apOc = parseInt(data.aprCountOpd) || 0;
        var myIc = parseInt(data.mayCountIpd) || 0; var myOc = parseInt(data.mayCountOpd) || 0;
        var juIc = parseInt(data.junCountIpd) || 0; var juOc = parseInt(data.junCountOpd) || 0;
        var jlIc = parseInt(data.julCountIpd) || 0; var jlOc = parseInt(data.julCountOpd) || 0;
        var auIc = parseInt(data.augCountIpd) || 0; var auOc = parseInt(data.augCountOpd) || 0;
        var seIc = parseInt(data.sepCountIpd) || 0; var seOc = parseInt(data.sepCountOpd) || 0;
        var ocIc = parseInt(data.octCountIpd) || 0; var ocOc = parseInt(data.octCountOpd) || 0;
        var noIc = parseInt(data.novCountIpd) || 0; var noOc = parseInt(data.novCountOpd) || 0;
        var deIc = parseInt(data.decCountIpd) || 0; var deOc = parseInt(data.decCountOpd) || 0;

          var options = {
            series: [{
                        name: 'IPD',
                        data: [jaIc, feIc, maIc, apIc, myIc, juIc, jlIc, auIc, seIc, ocIc, noIc, deIc]
                    }, {
                        name: 'OPD',
                        data: [jaOc, feOc, maOc, apOc, myOc, juOc, jlOc, auOc, seOc, ocOc, noOc, deOc]
                    }],
            chart: {
                type: 'bar',
                height: 300,
                stacked: true,
                toolbar: {
                    show: false
                },
                zoom: {
                    enabled: true
                }
            },
            colors: ['var(--chart-color1)', 'var(--chart-color2)'],
            responsive: [
                {
                    breakpoint: 480,
                    options: {
                        legend: {
                            position: 'bottom',
                            offsetX: -10,
                            offsetY: 0
                        }
                    }
                }
            ],
            xaxis: {
                categories: [
                    'Jan', 'Feb', 'March', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'
                ],
            },
            legend: {
                position: 'top',
                horizontalAlign: 'right',
            },
            dataLabels: {
                enabled: false,
            },
            fill: {
                opacity: 1
            }
        };

        var chart = new ApexCharts(document.querySelector("#newborn-resources"), options);
        chart.render();

      },
      error: function(jqXHR, textStatus, errorThrown) {
          console.error("Error fetching data: " + textStatus, errorThrown);
      }
    });
  });  
});