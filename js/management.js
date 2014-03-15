function toManagement() {
w=new Worker("js/workers/logWorker.js");
startWorker();
}
function fromManagement() {
stopWorker();
}