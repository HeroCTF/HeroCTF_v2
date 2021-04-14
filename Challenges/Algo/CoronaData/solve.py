#!/usr/bin/env python3
import pandas as pd

df = pd.read_csv("corona.csv", delimiter=",")

print(df["cas_confirmes"].max())