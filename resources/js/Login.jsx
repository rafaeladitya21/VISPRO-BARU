import React, { useState } from 'react';

const Login = () => {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');

  const handleLogin = (e) => {
    e.preventDefault();
    // Logika untuk mengirim data login ke backend (Laravel)
    console.log("Login dengan:", email, password);
  };

  return (
    // bg-orange-500 memberikan warna background orange
    <div className="flex items-center justify-center min-h-screen bg-orange-500">
      <div className="px-8 py-6 text-left bg-white shadow-lg rounded-xl">
        <h3 className="text-2xl font-bold text-center text-gray-800">Login Admin</h3>
        <form onSubmit={handleLogin}>
          <div className="mt-4">
            <div>
              <label className="block text-gray-700">Email</label>
              <input type="email" placeholder="Email"
                className="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-orange-500"
                value={email} onChange={(e) => setEmail(e.target.value)} required />
            </div>
            <div className="mt-4">
              <label className="block text-gray-700">Password</label>
              <input type="password" placeholder="Password"
                className="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-orange-500"
                value={password} onChange={(e) => setPassword(e.target.value)} required />
            </div>
            <div className="flex items-baseline justify-between">
              {/* Tombol login berwarna orange gelap */}
              <button className="w-full px-6 py-2 mt-6 text-white bg-orange-600 rounded-lg hover:bg-orange-700">
                Masuk
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  );
};

export default Login;

