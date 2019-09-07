function _(x) {
  return document.getElementById(x);
}

$(document).ready(function() {
  var menu = document.getElementById("primary-menu");
  var links = menu.getElementsByTagName("a");
  var radType = document.getElementsByName("type");
  var radCourse = document.getElementsByName("course");
  var radYear = document.getElementsByName("year");
  var radDept = document.getElementsByName("dept");
  var btnSearch = _("search-submit-btn");
  var majorsBtn = document.getElementsByClassName("majors-btn");
  var coursesBtn = document.getElementsByClassName("courses-btn");

  var course = "";
  var year = "";
  var type = "";
  var department = "";

  if (document.URL == "http://onlineresourcelibrary.curtisvannor.com/") {
    for (i = 0; i < majorsBtn.length; i++) {
      majorsBtn[i].addEventListener("click", function() {
        department = this.getAttribute("name");
        window.location.assign(
          "http://onlineresourcelibrary.curtisvannor.com/find-resources/"
        );
        return department;
      });
    }

    for (i = 0; i < coursesBtn.length; i++) {
      coursesBtn[i].addEventListener("click", function() {
        course = this.getAttribute("name");
        window.location.assign(
          "http://onlineresourcelibrary.curtisvannor.com/find-resources/"
        );
        return course;
      });
    }
  }

  if (
    document.URL ==
    "http://onlineresourcelibrary.curtisvannor.com/find-resources/"
  ) {
    console.log(course);
    console.log(department);

    loadProduct(course, year, type, department);

    btnSearch.addEventListener("click", function() {
      var search = _("search-content").value;
      if (search != "") {
        console.log(search);
        var data = {
          action: "filter_action",
          search: search
        };
        // We can also pass the url value separately from ajaxurl for front end AJAX implementations
        jQuery.post(ajax_object.ajax_url, data, function(response) {
          if (response != "") {
            console.log(response);
            $("#maincontent").html(response);
          }
        });
      }
    });
  }

  for (var i = 0; i < radType.length; i++) {
    radType[i].addEventListener("change", function() {
      type = this.value;
      var data = {
        action: "filter_action",
        course: course,
        year: year,
        type: type,
        department: department
      };
      // We can also pass the url value separately from ajaxurl for front end AJAX implementations
      jQuery.post(ajax_object.ajax_url, data, function(response) {
        console.log(response);
        $("#maincontent").html(response);
      });
    });
  }

  for (var i = 0; i < radCourse.length; i++) {
    radCourse[i].addEventListener("change", function() {
      course = this.value;
      var data = {
        action: "filter_action",
        course: course,
        year: year,
        type: type,
        department: department
      };
      // We can also pass the url value separately from ajaxurl for front end AJAX implementations
      jQuery.post(ajax_object.ajax_url, data, function(response) {
        console.log(response);
        $("#maincontent").html(response);
      });
    });
  }

  for (var i = 0; i < radYear.length; i++) {
    radYear[i].addEventListener("change", function() {
      year = this.value;
      var data = {
        action: "filter_action",
        course: course,
        year: year,
        type: type,
        department: department
      };
      // We can also pass the url value separately from ajaxurl for front end AJAX implementations
      jQuery.post(ajax_object.ajax_url, data, function(response) {
        console.log(response);
        $("#maincontent").html(response);
      });
    });
  }

  for (var i = 0; i < radDept.length; i++) {
    radDept[i].addEventListener("change", function() {
      department = this.value;
      var data = {
        action: "filter_action",
        course: course,
        year: year,
        type: type,
        department: department
      };
      // We can also pass the url value separately from ajaxurl for front end AJAX implementations
      jQuery.post(ajax_object.ajax_url, data, function(response) {
        console.log(response);
        $("#maincontent").html(response);
      });
    });
  }

  for (
    i = 0;
    i < document.getElementsByClassName("dropdown-toggle").length;
    i++
  ) {
    document
      .getElementsByClassName("dropdown-toggle")
      [i].parentElement.getElementsByTagName("DIV")[0].style.display = "none";
  }

  for (i = 0; i < links.length; i++) {
    links[i].addEventListener(
      "click",
      function(event) {
        for (j = 0; j < links.length; j++) {
          links[j].parentNode.classList.remove("li-active");
        }
        links[i].parentNode.classList.add("li-active");
        console.log("handler is working...");
      },
      false
    );
  }
});

var x = 0;
function toggleBtn(el) {
  var num = x % 2;
  if (num == 0) {
    el.parentElement.getElementsByTagName("DIV")[0].style.display = "block";
  } else {
    el.parentElement.getElementsByTagName("DIV")[0].style.display = "none";
  }
  x = x + 1;
}

function asyncTest() {
  var data = {
    action: "test_action"
  };
  // We can also pass the url value separately from ajaxurl for front end AJAX implementations
  jQuery.post(ajax_object.ajax_url, data, function(response) {
    alert("Got this from the server: " + response);
  });
}

function uploadResource() {
  var subject = _("major").value;
  var title = _("course-title").value;
  var id = _("course-id").value;
  var desc = _("desc-short").value;
  var type = _("resource-type").value;
  var file = _("filename").files[0];
  var frm = _("upload-form");
  var form_data = new FormData();
  form_data.append("file", file);

  if (
    subject == "" ||
    title == "" ||
    id == "" ||
    desc == "" ||
    type == "" ||
    file == ""
  ) {
    _("status").innerHTML = "Please fill out all required fields";
  } else {
    _("status").innerHTML = "Please wait ...";
    var data = {
      action: "upload_action",
      major: subject,
      "course-title": title,
      "course-id": id,
      "resource-type": type,
      "desc-short": desc,
      file: form_data
    };
    // We can also pass the url value separately from ajaxurl for front end AJAX implementations
    jQuery.post(
      ajax_object.ajax_url,
      data,
      function(response) {
        console.log(form_data[0]);
        _("status").innerHTML = response;
        frm.reset();
      }
    );
  }
}

function resetBtn() {
  var radType = document.getElementsByName("type");
  var radCourse = document.getElementsByName("course");
  var radYear = document.getElementsByName("year");
  var radDept = document.getElementsByName("dept");
  radCourse[0].checked = true;
  radDept[0].checked = true;
  radType[0].checked = true;
  radYear[0].checked = true;

  /*var data = {
    action: "filter_action",
    reset: "yep"
  };
  // We can also pass the url value separately from ajaxurl for front end AJAX implementations
  jQuery.post(ajax_object.ajax_url, data, function(response) {
    console.log(response);
    $("#maincontent").html(response);
  });*/
}

function loadProduct(a, b, c, d) {
  var data = {
    action: "filter_action",
    course: a,
    year: b,
    type: c,
    department: d
  };
  // We can also pass the url value separately from ajaxurl for front end AJAX implementations
  jQuery.post(ajax_object.ajax_url, data, function(response) {
    console.log(response);
    $("#maincontent").html(response);
  });
}
