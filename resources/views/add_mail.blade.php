<form type="POST" action= {{ route(STORE_NEW_MAIL) }}>
    @csrf
  <div class="form-group">
    <label for="subscriberEmail">Subscriber Email</label>
    <input type="email" class="form-control" name="email" placeholder="Subscriber Email">
  </div>

  <div class="form-group" style="margin-top: 5px;">
    <label for="senderFirstName">First name</label>
    <input type="text" class="form-control" name="firstName" placeholder="First name">
  </div>

  <div class="form-group" style="margin-top: 5px;">
    <label for="senderLastName">Last name</label>
    <input type="text" class="form-control" name="lastName" placeholder="Last name">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
