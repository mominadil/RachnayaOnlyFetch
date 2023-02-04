// Selecting sidebar nav icon

const sidebarNavIcon = document.querySelector(".sidebar-head-nav");

const sidebarBookCategories = document.querySelector(".bk-ctgs");

const headerNavIcon = document.querySelector(".nav-hamburger");


const navLinkContainer=document.querySelector('.nav-link-con')



// Adding event listeners to icons


sidebarNavIcon.addEventListener("click", () => {
  sidebarBookCategories.classList.toggle("move-left");
});

headerNavIcon.addEventListener("click", () => {

 navLinkContainer.classList.toggle('move-down-nav')

 
});

// Jquery Below

/*$(function () {
  var toggle;
  return (toggle = new Toggle(".toggle"));
});

this.Toggle = (function () {
  Toggle.prototype.el = null;

  Toggle.prototype.tabs = null;

  Toggle.prototype.panels = null;

  function Toggle(toggleClass) {
    this.el = $(toggleClass);
    this.tabs = this.el.find(".tab");
    this.panels = this.el.find(".panel");
    this.bind();
  }

  Toggle.prototype.show = function (index) {
    var activePanel, activeTab;
    this.tabs.removeClass("active");
    activeTab = this.tabs.get(index);
    $(activeTab).addClass("active");
    this.panels.hide();
    activePanel = this.panels.get(index);
    return $(activePanel).show();
  };

  Toggle.prototype.bind = function () {
    var _this = this;
    return this.tabs.unbind("click").bind("click", function (e) {
      return _this.show($(e.currentTarget).index());
    });
  };

  return Toggle;
})();*/


const sidebarElements = document.querySelector(".bk-ctgs");

let highletedIndex = -1;

sidebarElements.addEventListener("click", (e) => {
  const listItem = e.target.closest("li");
  const list = document.querySelector(".bk-ctgs ").children;

  const index = [...sidebarElements.children].indexOf(listItem);

  if (listItem) {
    if (highletedIndex >= 0) {
      list[highletedIndex].classList.remove("active");

      list[highletedIndex].children[0].classList.remove("link-white");
    }
  }

  list[index].classList.add("active");
  list[index].children[0].classList.add("link-white");
  highletedIndex = index;
});
