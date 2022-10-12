<x-layout>

    <div class="container pt-5">
        <div class="row">
            <h1 class="text-center text-secondary my-5">Register Here</h1>
            <div class="col-lg-3 col-md-1"></div>
            <div class="col-lg-6 col-md-10 shadow p-5 mt-2 border border-2">
                <form action="/register" method="POST" class="p-3 mb-3">
                    @csrf
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" name="username" class="form-control"
                            value="{{ old('username') }}" autocomplete="off" placeholder="Eg:@mgmg" required>

                        <x-error name="username" />

                    </div>

                    <div class="mb-3">
                        <label for="displayName" class="form-label">Display Name</label>
                        <input type="text" name="name" id="displayName" class="form-control" value="{{ old('name') }}"
                            autocomplete="off" required>

                        <x-error name="name" />

                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}"
                            autocomplete="off" required>

                        <x-error name="email" />
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password" required>

                        <x-error name="password" />
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                </form>

                <div class="text-center">
                    <p>Already have Account!
                        <a href="/login" class="text-decoration-none fw-bold">Login here</a>
                    </p>
                </div>
            </div>
            <div class="col-lg-3 col-md-1"></div>
        </div>
    </div>

</x-layout>
