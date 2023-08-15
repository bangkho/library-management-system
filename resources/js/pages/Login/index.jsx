import React from "react";
import { useForm } from "react-hook-form";
import { yupResolver } from "@hookform/resolvers/yup";
import * as yup from "yup";
import { useMutation } from "@tanstack/react-query";
import { toast } from "react-toastify";
import { loginUser } from "../../services/Auth";

export default function Login() {
  return (
    <div className="py-20 px-10 bg-white min-h-screen">
      <h1 className="text-xl font-bold mb-5">Library Management System</h1>
      <LoginForm />
    </div>
  );
}

const schema = yup.object().shape({
  email: yup.string().email().required(),
  password: yup.string().required().min(6)
});

function LoginForm() {
  // const { mutate } = useMutation({
  //   mutationFn: (data) => {
  //     loginUser(data)
  //   },
  //   onError: async (err) => {
  //     console.log(err, 'test');
  //     toast.error('Email atau Password Salah')
  //   },
  //   onSuccess: async (res) => {
  //     console.log(res, 'asda');
  //     toast.success('Anda Berhasil Login')
  //   },
  // })

  const { register, handleSubmit, errors } = useForm({
    mode: "onBlur",
    resolver: yupResolver(schema)
  });

  async function loginSubmit(data) {
    await loginUser({ data: data })
  }

  return (
    <div>
      <form onSubmit={handleSubmit(loginSubmit)}>
        <div className="mb-8">
          <label
            htmlFor="email"
            className={`block font-bold text-sm mb-2 ${
              errors?.email ? "text-red-400" : "text-purple-400"
            }`}
          >
            Email
          </label>
          <input
            type="text"
            name="email"
            id="email"
            placeholder="email@library.com"
            className={`block w-full bg-transparent outline-none border-b-2 py-2 px-4  placeholder-purple-500${
              errors?.email
                ? "text-red-300 border-red-400"
                : "text-purple-200 border-purple-400"
            }`}
            {...register('email', { required: true })}
          />
          {errors?.email && (
            <p className="text-red-500 text-sm mt-2">
              A valid email is required.
            </p>
          )}
        </div>

        <div className="mb-8">
          <label
            htmlFor="password"
            className={`block font-bold text-sm mb-2 ${
              errors?.password ? "text-red-400" : "text-purple-400"
            }`}
          >
            Password
          </label>
          <input
            type="password"
            id="password"
            placeholder="password"
            className={`block w-full bg-transparent outline-none border-b-2 py-2 px-4  ${
              errors?.password ? "border-red-400" : "border-purple-400"
            }`}
            {...register('password', { required: true, minLength: 6 })}
          />
          {errors?.password && (
            <p className="text-red-500 text-sm mt-2">
              Your password is required.
            </p>
          )}
        </div>
        <button className="inline-block bg-yellow-500 text-yellow-800 rounded shadow py-2 px-5 text-sm">
          Login
        </button>
      </form>
    </div>
  );
}
