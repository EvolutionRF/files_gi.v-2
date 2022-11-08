<style>
    .copied {
        opacity: 0;
        position: absolute;
        right: 55px;
    }
</style>

<div class="text-center">
    <div class="text-bold">
        {{-- <label for="url">Link to Download</label> --}}
    </div>
    <div class="input-group">
        <input type="text" id="url" class="form-control" aria-label="Recipient's username"
            value="{{ route('file.download',$file->slug) }}" disabled>
        <span class="copied">Copied !</span>
        <div class="input-group-prepend">
            <button type="button" class="btn btn-info" onclick="myFunction()">
                <x-heroicon-s-document-duplicate style="width:17px" class="ml-0" /> Copy
            </button>
        </div>
    </div>

</div>
<hr>

<div class="text-center">
    <div class="text-bold">
        <label for="url">Click to Download</label>
    </div>

    <a href=" {{ route('file.download',$file->slug) }}" class=" btn btn-outline-secondary" type="button">
        <x-heroicon-s-arrow-down-tray style="width:17px" class="ml-0" /> Download
    </a>
</div>

<script>
    function myFunction() {
  // Get the text field
  var copyText = document.getElementById("url");

  // Select the text field
  copyText.select();
  copyText.setSelectionRange(0, 99999); // For mobile devices

   // Copy the text inside the text field
  navigator.clipboard.writeText(copyText.value);

  // Alert the copied text
  alert("Link Copied");
}


</script>
