function SW() {
  this.button = $('#notification-wrapper .refresh-btn');
  this.toast = $('#notification-wrapper');
  this.registerSW();
};

SW.prototype.registerSW = function() {
    if (!navigator.serviceWorker) return;
    const that = this;
    navigator.serviceWorker.register('/service-worker.js')
        .then(function(reg) {
            if (!navigator.serviceWorker.controller) return;
            if (reg.waiting) {
                that.updateReady(reg.waiting);
                return;
            }

            if (reg.installing) {
                that.trackInstall(reg.installing);
                return;
            }

            reg.addEventListener('updatefound', function() {
                that.trackInstall(reg.installing);
            });
            
            let refreshing;
            navigator.serviceWorker.addEventListener('controllerchange', function() {
                if (refreshing) return;

                window.location.reload();
                refreshing = true;
            });
        })
        .catch(function() {
            console.error('Tidak dapat menginstall service worker.');
        });
}

SW.prototype.trackInstall = function(worker) {
    const that = this;

    worker.addEventListener('statechange', function() {
        if (worker.state === 'installed') {
            that.updateReady(worker)
        }
    })
}

SW.prototype.updateReady = function(worker) {
    this.toast.addClass('show');

    this.button.on('click', function(event) {
        event.preventDefault();
        worker.postMessage({ action: 'skipWaiting' })      
    })
}