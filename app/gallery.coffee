# infinitescroll 1.5
$("#gallery").infinitescroll(
  nextSelector    : "a.next"
  navSelector     : "div#navigation"
  itemSelector    : "#gallery > div.gallery-part"
  loading:
    finished: undefined
    finishedMsg: "<em>Så er der ikke flere.</em>"
    img: $.infinitescroll.defaults.loading.img
    msg: null
    msgText: "Henter flere..."
    selector: null
    speed: 'fast'
    start: undefined
)

