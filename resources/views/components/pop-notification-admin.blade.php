<div id="custom-popup" style="width: 300px;height: 100px;position: fixed;z-index: 2;left: 75%;top: 15%;"
    x-data="{ showMessage: true, message: {{ $message }}, timeout: 3000 }" x-init="setTimeout(() => showMessage = false, timeout);" x-show="showMessage">
    <p style="color: green;font-size: 30px;" x-text="message"></p>
</div>
