@extends('layouts.publicLayouts.app')

@section('content')

    <style>
        /* CSS code */
        body {
            background-color: white;
            color: #fff;
            text-align: center;
            font-family: Arial, sans-serif;
        }

        .free-resources {
            padding: 20px;
        }

        .free-resources h1 {
            margin-bottom: 20px;
        }

        .free-resources p {
            margin-bottom: 20px;
        }

        .resource-buttons {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .resource-buttons button {
            background-color: #e0e0e0;
            border: none;
            border-radius: 5px;
            color: #000;
            padding: 10px 20px;
            margin: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .resource-buttons button:hover {
            background-color: #d0d0d0;
        }
    </style>

    <div class="free-resources">
        <h1>Geography Free Resources</h1>
        <p>This page provides access to complimentary resources designed to support your learning journey. These resources are synchronized with Abhigyan Academy's YouTube videos and are organized for your convenience. To optimize your learning experience, please view the corresponding YouTube videos before downloading any resources. Enjoy your studies!</p>
        <div class="container">
            
            <a  style="border: 3px solid white; font-size:1.5rem; padding: 20px; background-color: #e5e7eb; color: black; width: fit-content; white-space: nowrap; border-radius: 0.5rem; text-align: center; display: inline-block; transition: all 0.3s ease-in-out; margin: 2px;" target="_blank" href="https://drive.google.com/file/d/1ch2v8XwrCKfMgh92nAl92LanyN5zfRK2/view?usp=drive_link">Class 1</a>
            <a  style="border: 3px solid white; font-size:1.5rem; padding: 20px; background-color: #e5e7eb; color: black; width: fit-content; white-space: nowrap; border-radius: 0.5rem; text-align: center; display: inline-block; transition: all 0.3s ease-in-out; margin: 2px;" target="_blank" href="https://drive.google.com/file/d/1ACoCjzM2QBUhkxT4r6U6fsjIOgNpyr0J/view?usp=drive_link">Class 2</a>
            <a  style="border: 3px solid white; font-size:1.5rem; padding: 20px; background-color: #e5e7eb; color: black; width: fit-content; white-space: nowrap; border-radius: 0.5rem; text-align: center; display: inline-block; transition: all 0.3s ease-in-out; margin: 2px;" target="_blank" href="https://drive.google.com/file/d/1B1jhKMuLWD_6MKtC-l4AbpyEMHiLkIrP/view?usp=drive_link">Class 3</a>
            <a  style="border: 3px solid white; font-size:1.5rem; padding: 20px; background-color: #e5e7eb; color: black; width: fit-content; white-space: nowrap; border-radius: 0.5rem; text-align: center; display: inline-block; transition: all 0.3s ease-in-out; margin: 2px;" target="_blank" href="https://drive.google.com/file/d/1mqIitTdbO99bo2du_sP82jibMWpU7jd7/view?usp=drive_link">Class 4</a>
            <a  style="border: 3px solid white; font-size:1.5rem; padding: 20px; background-color: #e5e7eb; color: black; width: fit-content; white-space: nowrap; border-radius: 0.5rem; text-align: center; display: inline-block; transition: all 0.3s ease-in-out; margin: 2px;" target="_blank" href="https://drive.google.com/file/d/1IqzHY0KTl0ePlX1LrrcchGPEeYAk6gXj/view?usp=drive_link">Class 5</a>
            <a  style="border: 3px solid white; font-size:1.5rem; padding: 20px; background-color: #e5e7eb; color: black; width: fit-content; white-space: nowrap; border-radius: 0.5rem; text-align: center; display: inline-block; transition: all 0.3s ease-in-out; margin: 2px;" target="_blank" href="https://drive.google.com/file/d/1YeX3r4ZTCSEHRuAEalc_HscSFKOxEmpM/view?usp=drive_link">Class 6</a>

        </div>
    </div>
    
@endsection
