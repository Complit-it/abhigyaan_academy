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
        <h1>Chemistry Free Resources</h1>
        <p>This page provides access to complimentary resources designed to support your learning journey. These resources are synchronized with Abhigyan Academy's YouTube videos and are organized for your convenience. To optimize your learning experience, please view the corresponding YouTube videos before downloading any resources. Enjoy your studies!</p>
        <div class="container">
            
            <a  style="border: 3px solid white; font-size:1.5rem; padding: 20px; background-color: #e5e7eb; color: black; width: fit-content; white-space: nowrap; border-radius: 0.5rem; text-align: center; display: inline-block; transition: all 0.3s ease-in-out; margin: 2px;" target="_blank" href="https://drive.google.com/file/d/166vj0ut0VaTcVrZmuWAltuBKSsdhcuzv/view?usp=drive_link">Class 1</a>
            <a  style="border: 3px solid white; font-size:1.5rem; padding: 20px; background-color: #e5e7eb; color: black; width: fit-content; white-space: nowrap; border-radius: 0.5rem; text-align: center; display: inline-block; transition: all 0.3s ease-in-out; margin: 2px;" target="_blank" href="https://drive.google.com/file/d/1LXYPYOkU_2RG3tTbIDDYgiZyomO9sQ4K/view?usp=drive_link">Class 2</a>
            <a  style="border: 3px solid white; font-size:1.5rem; padding: 20px; background-color: #e5e7eb; color: black; width: fit-content; white-space: nowrap; border-radius: 0.5rem; text-align: center; display: inline-block; transition: all 0.3s ease-in-out; margin: 2px;" target="_blank" href="https://drive.google.com/file/d/1R7nOdWuK9FjLRAxNzat1pXyg-oA_O2ID/view?usp=drive_link">Class 3</a>
            <a  style="border: 3px solid white; font-size:1.5rem; padding: 20px; background-color: #e5e7eb; color: black; width: fit-content; white-space: nowrap; border-radius: 0.5rem; text-align: center; display: inline-block; transition: all 0.3s ease-in-out; margin: 2px;" target="_blank" href="https://drive.google.com/file/d/1dnZWLtIoyt0uY_NWC8BhnSI1zL0_RPwA/view?usp=sharing">Class 4</a>
            <a  style="border: 3px solid white; font-size:1.5rem; padding: 20px; background-color: #e5e7eb; color: black; width: fit-content; white-space: nowrap; border-radius: 0.5rem; text-align: center; display: inline-block; transition: all 0.3s ease-in-out; margin: 2px;" target="_blank" href="https://drive.google.com/file/d/1Foh4h7xgxgAi_ty7cfg0OwLUVA43qWtt/view?usp=drive_link">Class 5</a>
            <a  style="border: 3px solid white; font-size:1.5rem; padding: 20px; background-color: #e5e7eb; color: black; width: fit-content; white-space: nowrap; border-radius: 0.5rem; text-align: center; display: inline-block; transition: all 0.3s ease-in-out; margin: 2px;" target="_blank" href="https://drive.google.com/file/d/1GEV6fmwq7UtNxxYkJHf-YNj0nNrnAaN9/view?usp=drive_link">Class 6</a>

        </div>
    </div>
    

@endsection
