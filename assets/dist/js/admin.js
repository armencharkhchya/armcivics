$(document).ready(function () {
  
  var windowURL = window.location.href;
  pageURL = windowURL.substring(0, windowURL.lastIndexOf('/'));
  var x= $('a[href="'+pageURL+'"]');
      x.addClass('active');
      x.parent().addClass('active');
  var y= $('a[href="'+windowURL+'"]');
      y.addClass('active');
  y.parent().addClass('active');
  
  $.ajax({
    url: baseURL + 'admin/getAllCategories',
    success: function (result) {
      $('.select2ToTree').not(".itemSelect").prepend('<option value="0" class="11 non-left">Հիմնական</option>')
      $('.select2ToTree').each(function () {
        $(this).select2ToTree({
          treeData: {
            dataArr: JSON.parse(result)
          }
        });
      })    
    }
  })

  function readURL(input, element) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
          if (element == 'picture') {
            $('#pic').attr('src', e.target.result);
          }
          if (element == 'picturePDF') {
            $('#picPDF').attr('src', e.target.result);
          }  
          if (element == 'pictureStatic') {
            $('#picStatic').attr('src', e.target.result);
          }  
          if (element == 'pictureTeam') {
            $('#picTeam').attr('src', e.target.result);
         }  
         if (element == 'pictureTestimonials') {
            $('#picTestimonials').attr('src', e.target.result);
         }  
         if (element == 'pictureClient') {
            $('#picClient').attr('src', e.target.result);
          } 
        }
        reader.readAsDataURL(input.files[0]);
      }
  }
    
  $("#picture").change(function () {
      readURL(this,'picture');
  }); 
    
  $("#picturePDF").change(function () {
    readURL(this,'picturePDF');
  }); 
  
  $("#pictureStatic").change(function () {
    readURL(this,'pictureStatic');
  }); 
  
  $("#pictureTeam").change(function () {
    readURL(this,'pictureTeam');
  }); 
  
  $("#pictureTestimonials").change(function () {
    readURL(this,'pictureTestimonials');
  }); 
    
  $("#pictureClient").change(function () {
    readURL(this,'pictureClient');
  }); 
  
  var tagnames = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    prefetch: {
      cache: false,
      url: baseURL + 'admin/getAllTags',
      filter: function(list) {
        return $.map(list, function (data) {
          return { name: data.title }; });
      }
    }
  });
  
  tagnames.initialize();
  
  var elt = $('.tagsinput');  
   
  elt.tagsinput({
    typeaheadjs: {
      name: 'tagnames',
      displayKey: 'name',
      valueKey: 'name',
      source: tagnames.ttAdapter()
    }
  });

  $('.tt-input').blur(() => {    
    $('.tt-input').val('');
  })

  $('.addItem').click(function () {  
    $('#tagsinput').tagsinput('removeAll');
    // $('[name=lang]').val('1');
    var iframe = $('#longtext_ifr');
    iframe.ready(function () {
      iframe.contents().find("body").html('');
    });
  })
  
  $('.editItem').click(function () {
    var id = $(this).attr('data');
    $('#itemModal .modal-title').text('Խմբագրել նյութը');
    $('#itemModal button[type=submit]').text('Խմբագրել');
    $('.cont_input_files').empty();
    $.ajax({
      type: 'POST',
      url: baseURL + 'admin/getItemById',
      data: {id: id},
      success: function (data) {
        var item = JSON.parse(data).getItemById; 
        $('#itemModal [name=name_am]').val(item.name_am);
        // $('#itemModal [name=name_ru]').val(item.name_ru);
        // $('#itemModal [name=name_en]').val(item.name_en);
        $('#itemModal [name=text_am]').val(item.text_am);
        // $('#itemModal [name=text_ru]').val(item.text_ru);
        // $('#itemModal [name=text_en]').val(item.text_en);
        var iframe_am = $('#longtext_am_ifr');       
        // var iframe_ru = $('#longtext_ru_ifr');       
        // var iframe_en = $('#longtext_em_ifr');       
        iframe_am.ready(function () {         
          iframe_am.contents().find("body").html('');
            iframe_am.contents().find("body").append(item.longtext_am);
        }); 
        // iframe_ru.ready(function () {         
        //   iframe_ru.contents().find("body").html('');
        //     iframe_ru.contents().find("body").append(item.longtext_ru);
        // }); 
        // iframe_en.ready(function () {         
        //   iframe_en.contents().find("body").html('');
        //     iframe_en.contents().find("body").append(item.longtext_en);
        // }); 
        $('#pic').attr('src', baseURL + 'images/upload/' + item.img);  
        if(item.general == 1) {
          $('#checkbox').prop('checked', true);
        }else {
          $('#checkbox').prop('checked', false);
        }
        $("#itemModal [name=category]").select2ToTree({
          treeData: {
            dataArr: {},
            dftVal: item.category_id
          }
        });
         if(JSON.parse(item.files)[0].path != null) {
          $.each(JSON.parse(item.files), function (i, el) {
            $('.cont_input_files').append(`
                <div class="col-sm-6">
                    <div class="cont_input_files_item">
                      <span>${el.path}</span>
                      <i class="fa fa-trash text-danger fs-6 cursor-pointer ms-auto"
                        onClick="deleteFile(this, ${el.id})"></i>
                    </div>
                  </div>
            `)          
          })
        }
        $("#date").val(item.date);
        $("#start_date").val(item.start_date);
        $('#itemModal [name=item]').val(item.id);
        var tags = JSON.parse(data).getItemTags;
        var eltg = $('#tagsinput');
        eltg.tagsinput('removeAll');
        tags.forEach(element => {
          eltg.tagsinput('add', element.tag_name);
        });
      }
    })
  });
  
  $('.trashItem').click(function () {
    var del_id = $(this).attr('data');
    var $ele = $(this).parent().parent();
    var r = confirm("Հեռացնե՞լ նյութը։");
    if (r == true) {
      $.ajax({
        type: 'POST',
        url: baseURL + 'admin/deleteItem',
        data: {
          id: del_id
        },
        success: function (data) {
          if (data == "YES") {
            $ele.fadeOut().remove();
          } else {
            alert("Նյութը չհեռացվեց")
          }
        }
      })
    }
  });

  $('.sendItem').click(function(){
    $('#loading').show();
    var id= $(this).attr('data');
    var r = confirm("Ուղարկե՞լ նամակներ։");
    if (r == true) {
      $.ajax({
        type:'POST',
        url: baseURL + 'admin/sendEmailUsers',
        data: {id: id},
        dataType: 'json',                        
        success: function(response){
            alert(response.msg);
            $('#loading').hide();
        },
        error: function(response){
          alert('Խափանում');
          $('#loading').hide();
        }
      })
    }                   
  });

  $('.publishItem').click(function () {
    var _this = $(this);
    var id = $(this).attr('data');
    var publish = $(this).find('i').attr('data');
    $.ajax({
      type: 'POST',
      url: baseURL + 'admin/showItem',
      data: {
        id: id,
        publish: publish
      },
      dataType: 'json',
      success: function (data) {
        _this.toggleClass(' btn-danger ');
        _this.toggleClass(' btn-success ');
        _this.find('i').attr('data', data.publish);
        data.publish == 1 ? _this.attr('title', 'Չցուցադրել') : _this.attr('title', 'Ցուցադրել');
        $('.badge').text(data.count);  
        if (data.count > 0) {
          $('.shown-all-items').removeClass('btn-success');
          $('.shown-all-items').addClass('btn-danger');
        } else {
          $('.shown-all-items').addClass('btn-success');
          $('.shown-all-items').removeClass('btn-danger');
        }
      }
    })
  });
  
  $.datetimepicker.setLocale('hy');
  $('.datetimepicker').datetimepicker({ format: 'Y-m-d H:i:s' });
  $('.datepicker').datetimepicker({ timepicker: false, format: 'Y-m-d' });

  $(document).on("click", ".deleteUser", function(){
    var userId = $(this).data("userid"),
      hitURL = baseURL + "admin/deleteUser",
      currentRow = $(this);
    
    var confirmation = confirm("Համոզվա՞ծ եք հեռացնելու այս օգտագործողին:");
    
    if(confirmation) {
      $.ajax({
      type : "POST",
      dataType : "json",
      url : hitURL,
      data : { userId : userId } 
      }).done(function(data){
        console.log(data);
        currentRow.parents('tr').remove();
        if(data.status = true) { alert("Օգտագործողը հաջողությամբ հեռացվեց"); }
        else if(data.status = false) { alert("Օգտագործողի հեռացումը ձախողվեց"); }
        else { alert("Մուտքն արգելված է..!"); }
      });
    }
  });

  $(document).keypress(function(e) {
    if (e.keycode == 13 || e.which == 13) {
      e.preventDefault();
    }
  })

  $('[data-target="#editCategory"]').on('click', function () {
    $.ajax({
      type: 'POST',
      url: baseURL + 'admin/getCategoryByID',
      data: {
        id: this.dataset.id
      },
      success: function (result) {
          var data = JSON.parse(result)
          if (data.parent_id != '0') {
            $('.group-category').hide()
          } else {
            $('.group-category').show()
            $("#order_by").val(data.order_by)
          }
          
          $('[name="edit_1"]').val(data.name_am);
          $('[name="text"]').val(data.text);
        // $('[name="edit_2"]').val(data.name_ru);
        // $('[name="edit_3"]').val(data.name_en);
        $("[name=item]").val(data.id)
        
        $("#editCategories").select2ToTree({
          treeData: {
            dataArr: {},
            dftVal: data.parent_id
          }
        });
      }
    })
  });

  $('[data-edit="category"]').on('click', function () {
    $.ajax({
      type: 'POST',
      url: baseURL + 'admin/editCategory',
      data: {
        id: $("[name=item]").val(),
        parent_id: $('#editCategories').val(),
        name_am: $('[name="edit_1"]').val(),
        text: $('[name="text"]').val(),
        
        // name_ru: $('[name="edit_2"]').val(),
        // name_en: $('[name="edit_3"]').val(),
        order_by: $('#order_by').val()
      },
      success: function (result) {
        var data = JSON.parse(result)
        if (data.status) {
          alert(data.msg)
        //   location.reload()
        }
      }
    })
  })
  
  $('[data-add="category"]').on('click', function () {
    $.ajax({
      type: 'POST',
      url: baseURL + 'admin/addCategory',
      data: {
        parent_id: $('#addCategories').val(),
        name_am: $('[name="add_1"]').val(),
        text: $('[name="text"]').val(),        
        // name_ru: $('[name="add_2"]').val(),
        // name_en: $('[name="add_3"]').val()
      },
      success: function (result) {
        var data = JSON.parse(result)
        if (data.status) {
          alert(data.msg)
          location.reload()
        }
      }
    })
  })  

  $('[data-delete="category"]').on('click', function () {
    $.ajax({
      type: 'POST',
      url: baseURL + 'admin/deleteCategory',
      data: {
        id: $(this).data('id'),
      },
      success: function (result) {
        var data = JSON.parse(result)
        if (data.status) {
          alert(data.msg)
          location.reload()
        }
      }
    })
  })
  
  $('.editArchive').click(function () {
    $('#archiveModal .modal-title').text('Խմբագրել նյութը');
    $('#archiveModal button[type=submit]').text('Խմբագրել');
    var id = $(this).attr('data');
    $.ajax({
      type: 'POST',
      url: baseURL + 'admin/getArchiveById',
      data: {
        id: id
      },
      success: function (data) {
        var data = JSON.parse(data);
         $.each(data, function (fieldName, fieldMsg) {
          fieldName == 'id' ? fieldName = 'item' : '';
          $('#archiveModal').find('[name="' + fieldName + '"]').val(fieldMsg);
        });
        $('#picPDF').attr('src', baseURL + 'documents/img/' + data.img);  
      }
    })
  });
  
   $('.deleteArchive').click(function() {
    var del_id = $(this).attr('data');
    var $ele = $(this).parent().parent();
    var r = confirm("Հեռացնե՞լ նյութը։");
    if (r == true) {
      $.ajax({
        type: 'POST',
        url: baseURL + 'admin/deleteArchive',
        data: {
          id: del_id
        },
        success: function(data) {
          if (data == "YES") {
            $ele.fadeOut().remove();
          } else {
            alert("Նյութը չհեռացվեց")
          }
        }
      })
    }
  });   
  
   $('.editVideo').click(function () {
    var id = $(this).attr('data');
    $('#videoModal .modal-title').text('Խմբագրել Տեսանյութը');
    $('#videoModal button[type=submit]').text('Խմբագրել');
    $.ajax({
      type: 'POST',
      url: baseURL + 'admin/getVideoById',
      data: {id: id},
      success: function (data) {
        var data = JSON.parse(data); 
         $.each(data, function (fieldName, fieldMsg) {
          fieldName == 'id' ? fieldName = 'item' : '';
          $('#videoModal').find('[name="' + fieldName + '"]').val(fieldMsg);
        });
      }
    })
   });
  
  $('.trashVideo').click(function() {
    var id = $(this).attr('data');
    var $ele = $(this).parent().parent();
    var r = confirm("Հեռացնե՞լ տեսանյութը։");
    if (r == true) {
      $.ajax({
        type: 'POST',
        url: baseURL + 'admin/deleteVideo',
        data: {
          id: id
        },
        success: function(data) {
          if (data == "YES") {
            $ele.fadeOut().remove();
          } else {
            alert("Նյութը չհեռացվեց")
          }
        }
      })
    }
  });
  
  $('.editTeam').click(function () {
    var id = $(this).attr('data');
    $('#teamModal .modal-title').text('Խմբագրել թիմի անդամի տվյալները');
    $('#teamModal button[type=submit]').text('Խմբագրել');
    $.ajax({
      type: 'POST',
      url: baseURL + 'admin/getTeamById',
      data: {id: id},
      success: function (data) {
        var data = JSON.parse(data); 
          $.each(data, function (fieldName, fieldMsg) {
          fieldName == 'id' ? fieldName = 'item' : '';
          $('#teamModal').find('[name="' + fieldName + '"]').val(fieldMsg);
        });
        $('#picTeam').attr('src', baseURL + 'images/team/' + data.img);  
      }
    })
   });
  
  $('.trashTeam').click(function() {
    var id = $(this).attr('data');
    var $ele = $(this).parent().parent();
    var r = confirm("Հեռացնե՞լ թիմի անդամին");
    if (r == true) {
      $.ajax({
        type: 'POST',
        url: baseURL + 'admin/deleteTeam',
        data: {
          id: id
        },
        success: function(data) {
          if (data == "YES") {
            $ele.fadeOut().remove();
          } else {
            alert("Չհեռացվեց")
          }
        }
      })
    }
  });
  
  $('.trashTestimonials').click(function() {
    var id = $(this).attr('data');
    var $ele = $(this).parent().parent();
    var r = confirm("Հեռացնե՞լ տվյալ կարծիքը");
    if (r == true) {
      $.ajax({
        type: 'POST',
        url: baseURL + 'admin/deleteTestimonials',
        data: {
          id: id
        },
        success: function(data) {
          if (data == "YES") {
            $ele.fadeOut().remove();
          } else {
            alert("Չհեռացվեց")
          }
        }
      })
    }
  });
    
  $('.editClient').click(function () {
    var id = $(this).attr('data');
    $('#clientModal .modal-title').text('Խմբագրել գործընկերոջ տվյալները');
    $('#clientModal button[type=submit]').text('Խմբագրել');
    $.ajax({
      type: 'POST',
      url: baseURL + 'admin/getClientById',
      data: {id: id},
      success: function (data) {
        var data = JSON.parse(data); 
         $.each(data, function (fieldName, fieldMsg) {
          fieldName == 'id' ? fieldName = 'item' : '';
          $('#clientModal').find('[name="' + fieldName + '"]').val(fieldMsg);
        });
        $('#picClient').attr('src', baseURL + 'images/client/' + data.img);  
      }
    })
   });
   
  $('.trashClient').click(function() {
    var id = $(this).attr('data');
    var $ele = $(this).parent().parent();
    var r = confirm("Հեռացնե՞լ գործընկերոջը");
    if (r == true) {
      $.ajax({
        type: 'POST',
        url: baseURL + 'admin/deleteClient',
        data: {
          id: id
        },
        success: function(data) {
          if (data == "YES") {
            $ele.fadeOut().remove();
          } else {
            alert("Չհեռացվեց")
          }
        }
      })
    }
  });
  
  $('.editSchoolGrants').click(function (e) {
    e.preventDefault();
    $('#schoolGrantsModal .modal-title').text('Խմբագրել նյութը');
    $('#schoolGrantsModal button[type=submit]').text('Խմբագրել');
    var id = $(this).attr('data');
    $.ajax({
      type: 'POST',
      url: baseURL + 'admin/getSchoolGrantById',
      data: {
        id: id
      },
      success: function (data) {
        var data = JSON.parse(data);
        $.each(data, function (fieldName, fieldMsg) {
          fieldName == 'id' ? fieldName = 'item' : '';
          $('#schoolGrantsModal').find('[name="' + fieldName + '"]').val(fieldMsg);
        });
      }
    })
  });
  
  $('.deleteSchoolGrants').click(function() {
    var del_id = $(this).attr('data');
    var $ele = $(this).parent().parent();
    var r = confirm("Հեռացնե՞լ նյութը։");
    if (r == true) {
      $.ajax({
        type: 'POST',
        url: baseURL + 'admin/deleteSchoolGrants',
        data: {
          id: del_id
        },
        success: function(data) {
          if (data == "YES") {
            $ele.fadeOut().remove();
          } else {
            alert("Նյութը չհեռացվեց")
          }
        }
      })
    }
   }); 
  
  $('.editCivilSocietyCrowdfunding').click(function (e) {
    e.preventDefault();
    $('#civilSocietyCrowdfundingModal .modal-title').text('Խմբագրել նյութը');
    $('#civilSocietyCrowdfundingModal button[type=submit]').text('Խմբագրել');
    var id = $(this).attr('data');
    $.ajax({
      type: 'POST',
      url: baseURL + 'admin/getCivilSocietyCrowdfundingById',
      data: {
        id: id
      },
      success: function (data) {
        var data = JSON.parse(data);
        $.each(data, function (fieldName, fieldMsg) {
          fieldName == 'id' ? fieldName = 'item' : '';
          $('#civilSocietyCrowdfundingModal').find('[name="' + fieldName + '"]').val(fieldMsg);
        });
      }
    })
  });
  
  $('.deleteCivilSocietyCrowdfunding').click(function() {
    var del_id = $(this).attr('data');
    var $ele = $(this).parent().parent();
    var r = confirm("Հեռացնե՞լ նյութը։");
    if (r == true) {
      $.ajax({
        type: 'POST',
        url: baseURL + 'admin/deleteCivilSocietyCrowdfunding',
        data: {
          id: del_id
        },
        success: function(data) {
          if (data == "YES") {
            $ele.fadeOut().remove();
          } else {
            alert("Նյութը չհեռացվեց")
          }
        }
      })
    }
  }); 
  
  $('#itemModal,#videoModal,#teamModal,#clientModal,#schoolGrantsModal,#archiveModal,#civilSocietyCrowdfundingModal').on('hidden.bs.modal', function (e) {
    if ($(this).attr('id') == 'itemModal' || $(this).attr('id') == 'archiveModal') {
      $(this).find(".modal-title").text('Ավելացնել նյութ');
     }
    if ($(this).attr('id') == 'videoModal') {
      $(this).find(".modal-title").text('Ավելացնել տեսանյութ');
    }    
    if ($(this).attr('id') == 'teamModal') {
      $(this).find(".modal-title").text('Ավելացնել թիմի անդամ');
    }
    if ($(this).attr('id') == 'clientModal') {
      $(this).find(".modal-title").text('Ավելացնել նոր գործընկեր');
    }
    if ($(this).attr('id') == 'schoolGrantsModal') {
      $(this).find(".modal-title").text('Ավելացնել դպրոցական դրամաշնորհային ծրագիր');
    }
     if ($(this).attr('id') == 'civilSocietyCrowdfundingModal') {
      $(this).find(".modal-title").text('Ավելացնել քաղաքացիական հասարակության դրամաշնորհային ծրագրեր');
     }
     var iframe_am = $('#longtext_am_ifr');     
     iframe_am.ready(function () {         
       iframe_am.contents().find("body").html('');
     }); 
    $(this)
      .find("input,textarea,select")
      .val('')
      .end()
      .find("input[type=checkbox], input[type=radio]")
      .prop("checked", "")
      .end()
      .find("img")
      .attr('src', '')
      .end()
      .find("input[name=date],input[name=time]")
      .val(dateNow)
      .end()
    //   .find("select[name=lang]")
    //   .val('1')
      .end()
      .find("button[type=submit]")
      .text('Ավելացնել')
      .end();
  })

  $('[data-toggle="tooltip"]').tooltip({
    container: 'body',
    placement: 'top',
    trigger: 'hover',
    html: true,
    title: ''
  });
});