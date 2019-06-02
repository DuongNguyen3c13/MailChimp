<form type="POST" action= {{ route(CREATE_NEW_CAMPAIGN) }}>
    @csrf
  <div class="form-group">
    <label for="senderEmail">Sender Email</label>
    <input type="email" class="form-control" name="email" placeholder="Sender email">
  </div>

  <div class="form-group" style="margin-top: 5px;">
    <label for="senderName">Sender Name</label>
    <input type="text" class="form-control" name="name" placeholder="Sender name">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
